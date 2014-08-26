# CiviCRM Community stats

This repository contains code for generating statistics about the CiviCRM community.

These statistics can come from anonymous ping backs and from other sources.

The basic idea is that we generate statistics in json that can be consumed in different places, for example via D3JS on http://stats.civicrm.org, or in other places such as blocks on civicrm.org, etc.

Statistics can be founf on URLS such as:

http://stats.civicrm.org/active-sites.html
http://stats.civicrm.org/active-sites.json


## Requirements
* copy of raw civicrm community statistics in a database names civicrm_stats_raw and another db called civicrm_stats
* composer

## Installation

/Although we only think we'll want one copy of the application runnning to provide ping back stats, installation instructions are provided here for those that want to further develop the application/

/These instructions presume that you are comfortable working with Symfony apps/

1. Clone the repository (git clone git@github.com:michaelmcandrew/civicrm-community-stats.git)

2. Do a standard composer install(cd civicrm-community-stats, composer install, etc.). You should name the database civicrm_stats when prompted (including warming up the production cache with 'app/console cache:clear --env=prod', etc.)

3. Configure your webserver to serve the application from http://stats (or similar)

4. Ensure that a recent copy of CiviCRM's raw statistics are present in a database names civicrm_stats_raw

5. From the application root, run src/bin/rebuild.sh

6. Visit http://stats/sites/active. You should see a json response of the current estimated active sites

## Ping backs

All ping backs are anonymous.

src/bin/import.sql takes the raw stats database and converts it into a format more suitable for analysis, which matches the Doctrine entities defined in Civi/CommunityStatsBundle/Entity/

* Site represents a unique site
* Ping represents a ping from a site
* Extension holds information on what extensions and components were enabled during a ping
* Entity holds information on how many entities of different types were found during a ping

### Defining active sites

We need to do some work to get from our ping backs to an accurate list of active installations.

We carry out different tests on sites to decide whether they are 'real'

Because of the number of sites we are dealing with, it makes sense to cache this information

Three tests that we can carry out are

* how many times has this site pinged back (e.g. should be >4)
* how much time has elapsed between the first and last ping (e.g. should be >90 days)
* when was the most recent ping (e.g. should be < 6 months ago)

More can tests can be added to these to ensure that we are not counting sites that should not be counted, for example:

* do not include sites which are obviously 'demonstration data' (based on number of contacts?)
* do not include test or development sites (how?)

### Improvements to the data model

Our current data model seperates sites and pings. The advantage of this is
* it allows us to track changes to sites over time.
The negative is that
* it requires a reasonably complex join to get the latest ping back from a site for whenever we want to ask questions like how many sites have CiviMember enabled since we need to join the site with the latest ping information (which is a fairly involved join). We then often need to join again to entities and extensions. I don't think group by or max can help us here because of the joins though we might be able to use subqueries to help.

A better solution might be to have a ping_latest table with a unique key of site_id which gets updated each time a ping comes in (rather than the ping getting added). We can then use that to join to entity and extension.

# Dealing with large tables

These are large tables, for example, there are > 300,000 individual pings and 4.5M entries in the entity table. Hence it is too processor intensive to carry out the tests each time that we want to work out what are active sites. For this reason, I've created columns in Site which can be used to store the results of these tests, which will then speed up the querying. My current thinking is that we should run these queries on a regular schedule. I've started to create Civi/CommunityStatsBundle/Command/UpdateSitesCommand.php for this task.

ping_latest (see improvements to the data model) is another way we can deal with this.

See also
--------

See http://wiki.civicrm.org/confluence/display/CRM/Community+Statistics for more information on how we want to develop statistics.









