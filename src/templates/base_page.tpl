<!DOCTYPE html>
{block name='config'}{strip}
  {assign var='page_title' value="`$app->config->site_title` - `$app->config->site_subtitle`"}
  {assign var='page_description' value=$app->config->site_description|escape:htmlall}
{/strip}{/block}
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="{$page_description}" />
    <title>{$page_title|escape:htmlall}</title>
    <link rel="alternate" type="application/rss+xml" href="{$app->config->app_uri}/rss" title="{$app->config->site_title|escape:htmlall} RSS Feed" />
    <link rel="alternate" type="application/atom+xml" href="{$app->config->app_uri}/atom" title="{$app->config->site_title|escape:htmlall} Atom Feed" />
    <link rel="apple-touch-icon" href="{$app->config->static_uri}/apple-touch-icon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="{$app->config->app_uri}/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{$app->config->static_uri}/style.css" />
    <script type="text/javascript" src="{$app->config->static_uri}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{$app->config->static_uri}/js/scripts.js"></script>
  </head>

  <!-- "The only thing standing between you and your goals is you... and your goals." -->

  <body>
    <div id="page">
      <div id="nav">
        <div class="inner">
          <a href="{$app->config->app_uri}/comic"{if $app->module_is('comic')} class="selected"{/if}>Comic</a>
          <a href="{$app->config->app_uri}/archive"{if $app->module_is('archive')} class="selected"{/if}>Archive</a>
          <a href="{$app->config->app_uri}/about"{if $app->module_is('about')} class="selected"{/if}>About</a>
          <a href="{$app->config->app_uri}/links"{if $app->module_is('links')} class="selected"{/if}>Links</a>
        </div>
      </div>

      <div id="logo">
        <a href="{$app->config->app_uri}/"></a>
        <h1 class="hidden">{$app->config->site_title|escape:htmlall}</h1>
        <p class="hidden">{$app->config->site_subtitle|escape:htmlall}</p>
      </div>

      <div id="contenttop"></div>
      <!-- Point where I stop caring how the generated markup looks -->
{block name='content'}{/block}
      <!-- Point where I start caring how the generated markup looks again -->
      <div id="contentbottom"></div>

      <div id="footer">
        <p>Scott Smitelli was here. Licensed under a <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/us/" rel="external">Creative Commons Attribution-Noncommercial-Share Alike 3.0 License</a>.</p>
        <p>
          <a href="http://validator.w3.org/check?uri=referer" rel="external"><img src="{$app->config->static_uri}/valid-html5.png" alt="Valid HTML5" /></a>
          <a href="http://jigsaw.w3.org/css-validator/validator?uri={$app->config->static_uri|urlencode}%2Fstyle.css" rel="external"><img src="{$app->config->static_uri}/valid-css.png" alt="Valid CSS 2.1" /></a>
          <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/us/" rel="license"><img src="{$app->config->static_uri}/cc-by-nc-sa.png" alt="Creative Commons License" title="Creative Commons Attribution-Noncommercial-Share Alike 3.0 United States License" /></a>
          <a href="http://validator.w3.org/feed/check.cgi?url={$app->config->app_uri|urlencode}%2Frss" rel="external"><img src="{$app->config->static_uri}/valid-rss.png" alt="Valid RSS 2.0" /></a>
          <a href="http://validator.w3.org/feed/check.cgi?url={$app->config->app_uri|urlencode}%2Fatom" rel="external"><img src="{$app->config->static_uri}/valid-atom.png" alt="Valid Atom 1.0" /></a>
        </p>
      </div>
    </div>
  </body>
</html>
