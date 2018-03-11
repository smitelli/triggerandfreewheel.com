{extends file='base_page.tpl'}
{block name='config' append}{strip}
  {assign var='page_title' value="Admin Panel | `$app->config->site_title`"}
{/strip}{/block}
{block name='content'}
  <div id="content">
    {if $admin->has_messages()}
      <ul style="background:#fdb; border:1px solid #876; padding:10px 25px;; margin-bottom:10px;">
        {foreach from=$admin->messages item='message'}
          <li>{$message|escape:htmlall}</li>
        {/foreach}
      </ul>
    {/if}
    {include file=$subtpl}
    {if $admin->is_logged_in()}
      <p class="c">
        <a href="{$app->config->app_uri}/admin/logout">Log Out</a>
      </p>
    {/if}
  </div>
{/block}
