{extends file='base_page.tpl'}
{block name='content'}
  <div id="content">
    <div class="posttop"></div>
    <div class="post">
      {if $code == 'database'}
        <div class="posttitle">Database Error</div>
        <p>
          The site is experiencing a temporary problem with its database. Try
          loading the page again in a few minutes.
        </p>
      {elseif $code == 403}
        <div class="posttitle">403 Forbidden</div>
        <p>
          You are trying to view content which the server is instructed not to
          provide to you.
        </p>
      {elseif $code == 404}
        <div class="posttitle">404 Not Found</div>
        <p>
          You are trying to view a page that does not exist on this site. It
          may have moved to another location, or it may have been removed
          entirely.
        </p>
      {elseif $code == 500}
        <div class="posttitle">500 Internal Server Error</div>
        <p>
          The server encountered a problem trying to form a response to your
          request. This is most likely a problem with the server itself.
        </p>
      {else}
        <div class="posttitle">Error</div>
      {/if}

      <p>
        If you followed a link here, contact the administrators of that site
        and let them know that they should update their content. If you feel
        that this error is unfounded and shouldn't be here, send a message to
        <a href="mailto:scott@triggerandfreewheel.com">scott@triggerandfreewheel.com</a>
        (be sure to include the full URL of the page you were trying to view and
        a short description of anything you may have done to trigger the
        error) and our crack web team will work to set things straight.
      </p>
      <p>
        Probably.
      </p>
      <div class="c"><a href="{$app->config->app_uri}/">Return to Trigger and Freewheel</a></div>
    </div>
    <div class="postbottom"></div>
  </div>
{/block}
