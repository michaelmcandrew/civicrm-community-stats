echo "Rebuilding CiviCRM community statistics database" 
mysql -e "drop database civicrm_stats"
mysql -e "create database civicrm_stats"
app/console doctrine:schema:create
mysql civicrm_stats < src/bin/import.sql
app/console sites:update
