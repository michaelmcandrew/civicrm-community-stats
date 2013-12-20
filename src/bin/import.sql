USE civicrm_stats_legacy;
DELETE FROM civicrm_stats.Extension;
DELETE FROM civicrm_stats.Entity;
DELETE FROM civicrm_stats.Ping;
DELETE FROM civicrm_stats.Site;

-- Add the sites (based on unique hashes)
INSERT INTO civicrm_stats.Site
    SELECT DISTINCT NULL, hash FROM stats
;

-- Add the ping backs
INSERT INTO civicrm_stats.Ping (site_id, uf, language, country, version, ufversion, mysqlversion, phpversion, paymentprocessors, time, legacy_stat_id) 
    SELECT
        Site.id, uf, lang, co, version, ufv, mysql, php, PPtypes, time, stats.id
    FROM civicrm_stats.Site
    JOIN stats
        ON Site.hash = stats.hash
;

-- Add the extensions
INSERT INTO civicrm_stats.Extension (ping_id, enabled, name, version) 
    SELECT
        Ping.id, extensions.enabled, extensions.name, extensions.version
    FROM civicrm_stats_legacy.extensions
    JOIN civicrm_stats.Ping ON Ping.legacy_stat_id = extensions.stat_id
;

-- Add the entities
INSERT INTO civicrm_stats.Entity (ping_id, name, count) 
    SELECT
        Ping.id, entities.name, entities.size
    FROM civicrm_stats_legacy.entities
    JOIN civicrm_stats.Ping ON Ping.legacy_stat_id = entities.stat_id
;
