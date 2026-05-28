#!/bin/sh
# Empire INK — Backup script
set -e

DB_NAME="wp_empire_ink"
BACKUP_DIR="/opt/docker/clients/empire-ink/backups"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="$BACKUP_DIR/wp_empire_ink_${TIMESTAMP}.sql.gz"
MAX_BACKUPS=4

mkdir -p "$BACKUP_DIR"

echo "==> Backing up database wp_empire_ink..."
docker exec shared-mariadb mariadb-dump \
    -u root -p"$(docker exec shared-mariadb printenv MARIADB_ROOT_PASSWORD)" \
    "wp_empire_ink" | gzip > "$BACKUP_FILE"

if [ -f "$BACKUP_FILE" ] && [ -s "$BACKUP_FILE" ]; then
    echo "==> Backup saved: $BACKUP_FILE ($(du -h "$BACKUP_FILE" | cut -f1))"
else
    echo "!!! Backup failed or empty."
    rm -f "$BACKUP_FILE"
    exit 1
fi

echo "==> Rotating old backups (keeping $MAX_BACKUPS)..."
BACKUP_COUNT=$(ls -1 "$BACKUP_DIR"/*.sql.gz 2>/dev/null | wc -l)
if [ "$BACKUP_COUNT" -gt "$MAX_BACKUPS" ]; then
    REMOVE_COUNT=$((BACKUP_COUNT - MAX_BACKUPS))
    ls -1t "$BACKUP_DIR"/*.sql.gz | tail -n "$REMOVE_COUNT" | while read -r old; do
        echo "    Removing: $(basename "$old")"
        rm -f "$old"
    done
fi

echo "==> Backup complete."
