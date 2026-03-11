DB_NAME="pizzakrakencom"

read -p "This will wipe your local $DB_NAME database. Continue? " -n 1 -r
echo    # (optional) move to a new line
if [[  $REPLY =~ ^[Nn]$ ]]
then
    echo "Aborted."
    exit 1
fi

# Load the MySQL username and password from the .env file
source .env

# Check to make sure we have LOCAL_MYSQL_USER and LOCAL_MYSQL_PASSWORD defined
# if not, prompt the user to enter them
if [ -z "$LOCAL_MYSQL_USER" ]; then
    read -p "Enter your local MySQL username: " LOCAL_MYSQL_USER
fi
if [ -z "$LOCAL_MYSQL_PASSWORD" ]; then
    read -p "Enter your local MySQL password: " LOCAL_MYSQL_PASSWORD
fi
echo

# Get yesterday's date in the format YYYY-MM-DD
YESTERDAY="${DB_NAME}_$(date -d "yesterday" +%Y%m%d)"

# Construct the path of the SQL dump file on the remote server
REMOTE_FILE_PATH="/db_backups/backup_$(date -d "yesterday" +%Y%m%d)_$DB_NAME.sql"

# Setup the directory
mkdir -p database_dumps
chmod 755 database_dumps

if ! [ -f "database_dumps/$YESTERDAY.sql" ]; then
    echo "Downloading database dump from remote server, please be patient..."
    # Use scp to download the file from the remote server to the local machine
    scp mark@68.46.84.167:$REMOTE_FILE_PATH database_dumps/$YESTERDAY.sql
fi

echo "Creating new $DB_NAME database from $YESTERDAY.sql"
echo "This may take a while, please be patient..."

# Drop and create the database
mysql -u $LOCAL_MYSQL_USER -p$LOCAL_MYSQL_PASSWORD -e "
    DROP DATABASE IF EXISTS ${DB_NAME};
    SET GLOBAL innodb_strict_mode=OFF;
    CREATE DATABASE ${DB_NAME}
        DEFAULT CHARACTER SET utf8mb4 
        DEFAULT COLLATE utf8mb4_general_ci;
"

# # Run the SQL dump file on a local mysql server
mysql -u $LOCAL_MYSQL_USER -p$LOCAL_MYSQL_PASSWORD $DB_NAME < database_dumps/$YESTERDAY.sql

echo "Done!"
