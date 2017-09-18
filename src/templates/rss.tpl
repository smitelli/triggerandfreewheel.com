<?xml version="1.0" encoding="UTF-8" ?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>{$app->config->site_title|escape:htmlall}</title>
    <atom:link href="{$app->config->app_uri}/rss" rel="self" type="application/rss+xml" />
    <link>{$app->config->app_uri}/</link>
    <description>{$app->config->site_subtitle|escape:htmlall}</description>
    <lastBuildDate>{$comics->format_date('rfc2822', $comics->archives[0])|escape:htmlall}</lastBuildDate>
    <language>en</language>
{foreach from=$comics->archives item='row'}
    <item>
      <title>{$row->post_title|escape:htmlall}</title>
      <link>{$app->config->app_uri}/comic/{$row->permalink}</link>
      <pubDate>{$comics->format_date('rfc2822', $row)|escape:htmlall}</pubDate>
      <guid isPermaLink="true">{$app->config->app_uri}/comic/{$row->permalink}</guid>
      <description><![CDATA[
        <p><img src="{$app->config->app_uri}/image/{$row->permalink}" alt="{$row->post_title|escape:htmlall}"></p>
        <p>{$tpl->bb_render($row->post_body)}</p>
      ]]></description>
    </item>
{/foreach}
  </channel>
</rss>
