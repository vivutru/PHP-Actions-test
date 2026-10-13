# Blue Peak Coffee Tours (demo site)

A fictional Jamaican booking website used to test deploying PHP with Docker on Render.

Structure:
- `public/`  pages and assets served by Apache
- `src/`     helpers and data, kept outside the web root
- `Dockerfile` builds the PHP 8.4 + Apache image

Render settings: Language = Docker, health check path = /status.php
