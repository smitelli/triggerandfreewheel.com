{extends file='base_page.tpl'}
{block name='config' append}{strip}
  {if $comics->is_specific()}
    {assign var='page_title' value="`$comics->current->post_title` | `$app->config->site_title`"}
    {assign var='page_description' value=$tpl->bb_render($comics->current->post_body, TRUE)}
  {/if}
{/strip}{/block}
{block name='content'}
  <div id="content">
    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">
        <div class="addthis_toolbox addthis_default_style sharebutton">
          <a class="addthis_counter addthis_pill_style"></a>
        </div>
        <a href="{$app->config->app_uri}/comic/{$comics->current->permalink}">{$comics->current->post_title|escape:htmlall}</a>
      </div>
      {strip}
        <div class="comicnav">
          {if $comics->has_oldest()}<a href="{$app->config->app_uri}/comic/{$comics->oldest->permalink}#content"><span class="hidden">First</span><img src="{$app->config->static_uri}/first.png" alt="First" /></a>{else}<img src="{$app->config->static_uri}/first-dis.png" alt="First" />{/if}
          {if $comics->has_previous()}<a href="{$app->config->app_uri}/comic/{$comics->previous->permalink}#content"><span class="hidden">Previous</span><img src="{$app->config->static_uri}/previous.png" alt="Previous" /></a>{else}<img src="{$app->config->static_uri}/previous-dis.png" alt="Previous" />{/if}
          <a href="{$app->config->app_uri}/random#content"><span class="hidden">Random</span><img src="{$app->config->static_uri}/random.png" alt="Random" /></a>
          {if $comics->has_next()}<a href="{$app->config->app_uri}/comic/{$comics->next->permalink}#content"><span class="hidden">Next</span><img src="{$app->config->static_uri}/next.png" alt="Next" /></a>{else}<img src="{$app->config->static_uri}/next-dis.png" alt="Next" />{/if}
          {if $comics->has_next()}<a href="{$app->config->app_uri}/comic#content"><span class="hidden">Current</span><img src="{$app->config->static_uri}/current.png" alt="Current" /></a>{else}<img src="{$app->config->static_uri}/current-dis.png" alt="Current" />{/if}
        </div>
      {/strip}
      <div class="comicimg">
        <img src="{$app->config->app_uri}/image/{$comics->current->permalink}" alt="{$comics->current->post_title|escape:htmlall}" />
      </div>
      {strip}
        <div class="comicnav">
          {if $comics->has_oldest()}<a href="{$app->config->app_uri}/comic/{$comics->oldest->permalink}#content"><span class="hidden">First</span><img src="{$app->config->static_uri}/first.png" alt="First" /></a>{else}<img src="{$app->config->static_uri}/first-dis.png" alt="First" />{/if}
          {if $comics->has_previous()}<a href="{$app->config->app_uri}/comic/{$comics->previous->permalink}#content"><span class="hidden">Previous</span><img src="{$app->config->static_uri}/previous.png" alt="Previous" /></a>{else}<img src="{$app->config->static_uri}/previous-dis.png" alt="Previous" />{/if}
          <a href="{$app->config->app_uri}/random#content"><span class="hidden">Random</span><img src="{$app->config->static_uri}/random.png" alt="Random" /></a>
          {if $comics->has_next()}<a href="{$app->config->app_uri}/comic/{$comics->next->permalink}#content"><span class="hidden">Next</span><img src="{$app->config->static_uri}/next.png" alt="Next" /></a>{else}<img src="{$app->config->static_uri}/next-dis.png" alt="Next" />{/if}
          {if $comics->has_next()}<a href="{$app->config->app_uri}/comic#content"><span class="hidden">Current</span><img src="{$app->config->static_uri}/current.png" alt="Current" /></a>{else}<img src="{$app->config->static_uri}/current-dis.png" alt="Current" />{/if}
        </div>
      {/strip}
      <div class="postbody">
        <strong>{$comics->format_date('long')|escape:htmlall}:</strong>
        {$tpl->bb_render($comics->current->post_body)}
      </div>
      {if $comics->is_specific()}
        <div class="c">
          <script type="text/javascript" src="http://www.ohnorobot.com/js/1484.js"></script>
          <script type="text/javascript">/* <![CDATA[ */
            transcribe('aplhs8eb.sxjE1484');
          /* ]]> */</script>
        </div>
      {/if}
    </div>
    <div class="postbottom"></div>
    
    <div class="share">
      <table class="sharetable">
        <!-- He's using tables for non-tabular data! Shun! -->
        <tr>
          <th class="r"><label for="curl">Link to this page:</label></th>
          <td><input type="text" value="{$app->config->app_uri}/comic/{$comics->current->permalink}" id="curl" class="sharebox" readonly="readonly" /></td>
          <td rowspan="2">
            <input type="radio" name="linktype" id="linktype_url" checked="checked" /><label for="linktype_url">Plain URLs</label><br />
            <input type="radio" name="linktype" id="linktype_html" /><label for="linktype_html">HTML tags</label><br />
            <input type="radio" name="linktype" id="linktype_bbcode" /><label for="linktype_bbcode">BBCode tags</label>
          </td>
        </tr>
        <tr>
          <th class="r"><label for="iurl">Link to the image:</label></th>
          <td><input type="text" value="{$app->config->app_uri}/image/{$comics->current->permalink}" id="iurl" class="sharebox" readonly="readonly" /></td>
        </tr>
        <tr>
          <td colspan="3" class="c">
            <a href="{$app->config->app_uri}/rss" rel="external"><img src="{$app->config->static_uri}/button-rss.png" alt="RSS Feed" /></a>
            <a href="{$app->config->app_uri}/atom" rel="external"><img src="{$app->config->static_uri}/button-atom.png" alt="Atom Feed" /></a>
          </td>
        </tr>
      </table>
      <p class="c">
        <strong>Do you enjoy this comic? Prove it.</strong><br />
        <a href="{$app->config->app_uri}/donate"><img src="{$app->config->static_uri}/button-donate.png" alt="Donate" /></a>
      </p>
    </div>
    
    <script type="text/javascript">/* <![CDATA[ */
      var meta = {
        'title':     '{$comics->current->post_title|escape:javascript} - {$app->config->site_title|escape:javascript}',
        'comic_url': '{$app->config->app_uri}/comic/{$comics->current->permalink}',
        'image_url': '{$app->config->app_uri}/image/{$comics->current->permalink}'
      };
    /* ]]> */</script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=vipersniper32"></script>
  </div>
  <!-- query count={$comics->get_query_count()}, query msec={$comics->get_query_timer()} -->
{/block}