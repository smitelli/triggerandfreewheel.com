{extends file='base_page.tpl'}
{block name='config' append}{strip}
  {assign var='page_title' value="Links | `$app->config->site_title`"}
{/strip}{/block}
{block name='content'}
  <div id="content">
    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">Links</div>

      <div class="columned">
        <p>Here are some webcomics, past and present, that I enjoy:</p>
        <ul>
          <li><a href="http://abstrusegoose.com/" rel="external">Abstruse Goose</a></li>
          <li><a href="http://www.thebookofbiff.com/" rel="external">The Book of Biff</a></li>
          <li><a href="http://www.breakpointcity.com/" rel="external">Breakpoint City</a></li>
          <li><a href="http://www.chainsawsuit.com/" rel="external">chainsawsuit</a></li>
          <li><a href="http://www.dieselsweeties.com/" rel="external">Diesel Sweeties</a></li>
          <li><a href="http://icantdrawfeet.com/" rel="external">I Can't Draw Feet</a></li>
          <li><a href="http://www.thisisindexed.com/" rel="external">Indexed</a></li>
          <li><a href="http://www.marriedtothesea.com/" rel="external">Married To The Sea</a></li>
          <li><a href="http://www.nataliedee.com/" rel="external">Natalie Dee</a></li>
          <li><a href="http://www.picturesforsadchildren.com/" rel="external">pictures for sad children</a></li>
          <li><a href="http://www.questionablecontent.net/" rel="external">Questionable Content</a></li>
          <li><a href="http://darrellmstark.com/comic/" rel="external">Rhetoric</a></li>
          <li><a href="http://www.smbc-comics.com/" rel="external">SMBC</a></li>
          <li><a href="http://www.superpoop.com/" rel="external">Superpoop</a></li>
          <li><a href="http://threepanelsoul.com/" rel="external">Three Panel Soul</a></li>
          <li><a href="http://www.toothpastefordinner.com/" rel="external">Toothpaste For Dinner</a></li>
          <li><a href="http://uncertaintyprinciple.comicgenesis.com/" rel="external">Uncertainty Principle</a></li>
          <li><a href="http://xkcd.com/" rel="external">xkcd</a></li>
        </ul>
      </div>
      <br style="clear:both;" />
    </div>
    <div class="postbottom"></div>
  </div>
{/block}
