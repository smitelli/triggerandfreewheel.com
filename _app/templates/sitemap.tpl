<?xml version="1.0" encoding="UTF-8" ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{foreach from=$app->config->page_list item='row'}
  <url>
    <loc>{$app->config->app_uri}{$row}</loc>
    <lastmod>{$rightnow|escape:htmlall}</lastmod>
    <changefreq>always</changefreq>
    <priority>1.0</priority>
  </url>
{/foreach}
{foreach from=$comics->archives item='row'}
  <url>
    <loc>{$app->config->app_uri}/comic/{$row->permalink}</loc>
    <lastmod>{$comics->format_date('iso8601', $row)|escape:htmlall}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.5</priority>
  </url>
{/foreach}
</urlset>