<?xml version="1.0" encoding="UTF-8" ?>

<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en">
  <title>{$app->config->site_title|escape:htmlall}</title>
  <subtitle>{$app->config->site_subtitle|escape:htmlall}</subtitle>
  <updated>{$comics->format_date('iso8601', $comics->archives[0])|escape:htmlall}</updated>
  <link href="{$app->config->app_uri}/" rel="alternate" />
  <link href="{$app->config->app_uri}/atom" rel="self" type="application/atom+xml" />
  <id>{$app->config->app_uri}/</id>
{foreach from=$comics->archives item='row'}
  <entry>
    <title>{$row->post_title|escape:htmlall}</title>
    <link href="{$app->config->app_uri}/comic/{$row->permalink}" rel="alternate" />
    <updated>{$comics->format_date('iso8601', $row)|escape:htmlall}</updated>
    <id>{$app->config->app_uri}/comic/{$row->permalink}</id>
    <summary type="html"><![CDATA[
      <p><img src="{$app->config->app_uri}/image/{$row->permalink}" alt="{$row->post_title|escape:htmlall}"></p>
      <p>{$tpl->bb_render($row->post_body)}</p>
    ]]></summary>
    <author>
      <name>{$app->config->site_title|escape:htmlall}</name>
    </author>
  </entry>
{/foreach}
</feed>