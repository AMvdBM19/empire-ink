# Empire INK — WordPress Site

## Quick Reference

| Key | Value |
|---|---|
| Client | Empire INK |
| Domain | empire-ink.nl |
| Slug | empire-ink |
| VPS Path | /opt/docker/clients/empire-ink |
| Container | wp-empire-ink |
| Theme | monoliet-starter |
| Database | wp_empire_ink @ shared-mariadb |

## Architecture

```
Internet → nginx-proxy-manager
└── empire-ink.nl → wp-empire-ink:80

Docker:
├── wp-empire-ink (WordPress 6.7 + PHP 8.3)
├── Theme: ./wp/wp-content/themes/monoliet-starter (mounted)
├── Plugins: /opt/docker/wp-factory/shared-plugins (read-only mount)
├── Uploads: Docker volume uploads-empire-ink
└── DB: shared-mariadb → wp_empire_ink
```

## Common Operations

### Restart
```bash
cd /opt/docker/clients/empire-ink
docker compose restart wordpress
```

### Check health
```bash
curl -s https://empire-ink.nl/wp-json/monoliet/v1/health | jq
```

### WP-CLI (inside container)
```bash
docker exec -it wp-empire-ink wp --allow-root <command>
```

### Backup
```bash
cd /opt/docker/clients/empire-ink
./backup.sh
```

### Push reviews (from n8n or cron)
```bash
curl -X POST https://empire-ink.nl/wp-json/monoliet/v1/reviews \
  -H "Content-Type: application/json" \
  -H "X-API-Key: <key>" \
  -d '[{"name":"John","rating":5,"text":"Great!","date":"2025-01-01","source":"Google"}]'
```

## Protected Zones

- **DO NOT** modify files in `/opt/docker/wp-factory/shared-plugins/` — use `update-shared-plugins.sh`
- **DO NOT** rebuild the shared-mariadb container
- **DO NOT** hardcode credentials — use `.env`
- **DO NOT** modify other clients' containers or volumes

## Customization

The only file that should change per client is:
`wp/wp-content/themes/monoliet-starter/assets/css/client.css`

Edit CSS custom properties to match the client's brand.

## Related

- WP Factory repo: monoliet-wp-factory
- Monoliet website: monoliet.cloud (separate project)
- Portal: portal.monoliet.cloud
