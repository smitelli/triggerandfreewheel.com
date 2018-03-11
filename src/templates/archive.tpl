{extends file='base_page.tpl'}
{block name='config' append}{strip}
  {assign var='page_title' value="Archive | `$app->config->site_title`"}
{/strip}{/block}
{block name='content'}
  <div id="content">
    {foreach from=$comics->archives item='row' name='rowloop'}
      {assign var='this_month' value=$comics->format_date('monthyear', $row)}
      {if $smarty.foreach.rowloop.first}
        <div class="posttop"></div>
        <div class="post"><div class="posttitle">{$this_month|escape:htmlall}</div>
      {elseif $this_month != $last_month}
        </div>
        <div class="postbottom"></div>
        <div class="posttop"></div>
        <div class="post"><div class="posttitle">{$this_month|escape:htmlall}</div>
      {/if}
      {strip}
        {$comics->format_date('short', $row)|escape:htmlall}&nbsp;&mdash;&nbsp;
        <a href="{$app->config->app_uri}/comic/{$row->permalink}">{$row->post_title|escape:htmlall}</a>
        <span class="excerpt"> &mdash; {$tpl->excerpt_render($row->post_body, 100)}</span>
        <br />
      {/strip}
      {if $smarty.foreach.rowloop.last}
        </div><div class="postbottom"></div>
      {/if}
      {assign var='last_month' value=$this_month}
    {/foreach}
  </div>
  <!-- query count={$comics->get_query_count()}, query msec={$comics->get_query_timer()} -->
{/block}
