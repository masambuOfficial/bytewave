#!/bin/bash

# Database Sync Script for BYTEWAVE
# Usage: ./sync-db.sh [pull|push]

REMOTE_HOST="grateful.crystalwebhost.com"
REMOTE_USER="bytewave_masambu"
REMOTE_PASS="04July@2020"
REMOTE_DB="bytewave_bytewave"

LOCAL_USER="root"
LOCAL_PASS="password"
LOCAL_DB="bytewave_bytewave"

BACKUP_DIR="database_backups"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

if [ "$1" == "pull" ]; then
    echo "🔄 Pulling database from REMOTE to LOCAL..."
    echo "📦 Creating backup of local database first..."
    
    # Backup local database before overwriting
    mysqldump -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB > "$BACKUP_DIR/local_backup_$TIMESTAMP.sql"
    
    echo "⬇️  Downloading remote database..."
    mysqldump -u $REMOTE_USER -p$REMOTE_PASS -h $REMOTE_HOST $REMOTE_DB > "$BACKUP_DIR/remote_$TIMESTAMP.sql"
    
    echo "📥 Importing to local database..."
    mysql -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB < "$BACKUP_DIR/remote_$TIMESTAMP.sql"
    
    echo "✅ Database pulled successfully!"
    echo "💾 Backup saved to: $BACKUP_DIR/local_backup_$TIMESTAMP.sql"
    
elif [ "$1" == "push" ]; then
    echo "⚠️  WARNING: You are about to OVERWRITE the REMOTE database!"
    echo "This will affect your LIVE production site!"
    read -p "Are you sure? (type 'yes' to continue): " confirm
    
    if [ "$confirm" != "yes" ]; then
        echo "❌ Push cancelled."
        exit 1
    fi
    
    echo "🔄 Pushing database from LOCAL to REMOTE..."
    echo "📦 Creating backup of remote database first..."
    
    # Backup remote database before overwriting
    mysqldump -u $REMOTE_USER -p$REMOTE_PASS -h $REMOTE_HOST $REMOTE_DB > "$BACKUP_DIR/remote_backup_$TIMESTAMP.sql"
    
    echo "⬆️  Exporting local database..."
    mysqldump -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB > "$BACKUP_DIR/local_$TIMESTAMP.sql"
    
    echo "📤 Importing to remote database..."
    mysql -u $REMOTE_USER -p$REMOTE_PASS -h $REMOTE_HOST $REMOTE_DB < "$BACKUP_DIR/local_$TIMESTAMP.sql"
    
    echo "✅ Database pushed successfully!"
    echo "💾 Backup saved to: $BACKUP_DIR/remote_backup_$TIMESTAMP.sql"
    
elif [ "$1" == "backup-remote" ]; then
    echo "📦 Backing up remote database..."
    mysqldump -u $REMOTE_USER -p$REMOTE_PASS -h $REMOTE_HOST $REMOTE_DB > "$BACKUP_DIR/remote_backup_$TIMESTAMP.sql"
    echo "✅ Remote backup saved to: $BACKUP_DIR/remote_backup_$TIMESTAMP.sql"
    
elif [ "$1" == "backup-local" ]; then
    echo "📦 Backing up local database..."
    mysqldump -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB > "$BACKUP_DIR/local_backup_$TIMESTAMP.sql"
    echo "✅ Local backup saved to: $BACKUP_DIR/local_backup_$TIMESTAMP.sql"
    
else
    echo "Usage: ./sync-db.sh [pull|push|backup-remote|backup-local]"
    echo ""
    echo "Commands:"
    echo "  pull           - Download remote database to local"
    echo "  push           - Upload local database to remote (DANGEROUS!)"
    echo "  backup-remote  - Create backup of remote database"
    echo "  backup-local   - Create backup of local database"
    exit 1
fi
