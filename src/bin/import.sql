-- Add the sites (based on unique hashes)
INSERT INTO civicrm_stats.Site (hash)
    SELECT DISTINCT  hash 
    FROM civicrm_stats_raw.stats
;

-- Add the ping backs
INSERT INTO civicrm_stats.Ping (site_id, uf, language, country, version, ufversion, mysqlversion, phpversion, paymentprocessors, time, legacy_stat_id) 
    SELECT
        Site.id, stats.uf, stats.lang, stats.co, stats.version, stats.ufv, stats.mysql, stats.php, stats.PPtypes, stats.time, stats.id
    FROM civicrm_stats.Site
    JOIN civicrm_stats_raw.stats
        ON Site.hash = stats.hash
    ORDER BY stats.time
;

-- Add the extensions
INSERT INTO civicrm_stats.Extension (ping_id, enabled, name, version) 
    SELECT
        Ping.id, extensions.enabled, extensions.name, extensions.version
    FROM civicrm_stats_raw.extensions
    JOIN civicrm_stats.Ping ON Ping.legacy_stat_id = extensions.stat_id
;

-- Add the entities
INSERT INTO civicrm_stats.Entity (ping_id, name, count) 
    SELECT
        Ping.id, entities.name, entities.size
    FROM civicrm_stats_raw.entities
    JOIN civicrm_stats.Ping ON Ping.legacy_stat_id = entities.stat_id
;
