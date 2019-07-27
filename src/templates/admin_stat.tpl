{assign var='last_viewcount_page' value=$admin->archives[0]->viewcount_page}
{assign var='last_viewcount_premiere' value=$admin->archives[0]->viewcount_premiere}
{assign var='last_viewcount_img' value=$admin->archives[0]->viewcount_img}
{assign var='total_viewcount_page' value=0}
{assign var='total_viewcount_img' value=0}
{assign var='total_byte_count' value=0}
    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">View Statistics</div>
      <p>
        The <span class="highlight">highlighted</span> cells indicate a
        &gt;50% increase from the previous day's value.
      </p>
      <style>
        #stat-table td { word-wrap: break-word; }
      </style>
      <table id="stat-table">
        {foreach from=$admin->archives item='row' name='clist'}
          {if ($smarty.foreach.clist.iteration - 1) % 25 == 0}
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Post</th>
              <th>Page Views</th>
              <th>Premiere Views</th>
              <th>Image Views</th>
              <th>Image Bytes</th>
            </tr>
          {/if}
          <tr style="background:{cycle values='#aaa,#999'};">
            <td class="c">{$smarty.foreach.clist.iteration}</td>
            <td class="c"><a href="{$app->config->app_uri}/comic/{$row->date}">{$row->date}</a></td>
            <td>
              <a href="{$app->config->app_uri}/comic/{$row->permalink}"><strong>{$row->post_title|escape:htmlall}</strong></a>
              <br>{$row->post_body|escape:htmlall}
            </td>
            <td class="r{if $row->viewcount_page > $last_viewcount_page * 1.5} highlight{/if}">{$row->viewcount_page|number_format}</td>
            <td class="r{if $row->viewcount_premiere > $last_viewcount_premiere * 1.5} highlight{/if}">{$row->viewcount_premiere|number_format}</td>
            <td class="r{if $row->viewcount_img > $last_viewcount_img * 1.5} highlight{/if}">{$row->viewcount_img|number_format}</td>
            <td class="r">{$row->byte_count|number_format}</td>
          </tr>
          {assign var='last_viewcount_page' value=$row->viewcount_page}
          {assign var='last_viewcount_premiere' value=$row->viewcount_premiere}
          {assign var='last_viewcount_img' value=$row->viewcount_img}
          {assign var='total_viewcount_page' value=$total_viewcount_page + $row->viewcount_page}
          {assign var='total_viewcount_img' value=$total_viewcount_img + $row->viewcount_img}
          {assign var='total_byte_count' value=$total_byte_count + $row->byte_count}
        {/foreach}
      </table>
      <p>
        {$total_viewcount_img|number_format} images served &mdash;
        {$total_viewcount_page|number_format} pages served &mdash;
        {($total_byte_count / 1048576)|number_format} MB transmitted.
      </p>
    </div>
    <div class="postbottom"></div>
