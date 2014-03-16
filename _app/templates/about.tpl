{extends file='base_page.tpl'}
{block name='config' append}{strip}
  {assign var='page_title' value="About | `$app->config->site_title`"}
{/strip}{/block}
{block name='content'}
  <div id="content">
    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">What's all this?</div>
      <strong>Trigger and Freewheel</strong> is a webcomic, simple as that. It updates at midnight Eastern time, Monday through Friday. There is no roster of characters or complicated storylines, just a joke a day. You can start reading any time, at any point in the archive, and not feel like you're missing anything.<br />
      <br />
      There have been {$comics->published_count()|escape:htmlall} published comics since April 1, 2008, when I started this. In retrospect, that was a pretty stupid day to begin. Now all my <em>n</em>-year anniversaries and April Fool's comics will have to be one and the same. Ah well.
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">Who draws this comic?</div>
      Well, I suppose I'll have to take the blame for that one.<br />
      <br />
      Oh, you want like a bio or something? Well, if you insist. I'm Scott Smitelli, a {$age|escape:htmlall} year old web guy/sound guy residing in or around the greater New York City area. I studied Computer Science at the Rochester Institute of Technology, which lasted all of two years. I transferred to the New York Film Academy, eventually doing freelance sound work on film and video projects. When the economy tanked in 2009, I jumped back to web development. In my spare time, I enjoy computers, music, dumpster diving, getting lost, the smell of rosin-core solder, meandering through Wikipedia, and making lists of things. Sentence fragments. Probably other stuff too.<br />
      <br />
      I'm easy to get in contact with. Just shoot an email to <code>scott[at]triggerandfreewheel[dot com]</code> (after reassembling that email address, of course) and who knows, I might even write something back!
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">What does &quot;Trigger and Freewheel&quot; mean?</div>
      It's a mode of synchronization in some audio software, and the opposite of &quot;Full Chase Lock.&quot; In the simplest terms, trigger and freewheel means that one audio device tells another to &quot;start playing now&quot; and nothing more. The two devices continue to play in sync because they share a common clock rate. In full chase lock, the first audio device not only tells the other one when to start, but also constantly announces the current chunk of time it should be playing. This looks more like &quot;start playing now... you should be at 0.01 seconds... 0.02 seconds... 0.03...&quot; the entire time. You'd think that full chase lock would offer better synchronization, but it often creates clicks or glitches in audio. Sound hardware doesn't like being micromanaged any more than the rest of us do.<br />
      <br />
      In actuality, I picked the name because it sounded kinda cool, and it didn't have many Google hits. ;)
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">Do you have any merchandise available?</div>
      Not yet, but I have plans to eventually have shirts (at the very least) and maybe anthology books or other printed tchotchkes. First I have to collect enough rabid fans to ensure that the stuff would actually get bought. But it's on my list.
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">I am intrigued and would like to subscribe to your newsletter.</div>
      Uhh, yeah. I'll just throw you a few links.<br />
      <ul>
        <li><a href="http://www.smitelli.com/" rel="external">Smitelli.com</a> - My personal website, more of a neglected dumping ground than anything else</li>
        <li><a href="http://www.scottsmitelli.com/" rel="external">Scott Smitelli.com</a> - My professional website, where you can see me attempt professionalism</li>
        <li><a href="http://vipersniper.dnsalias.com/moblog/" rel="external">Vipersniper Moblog</a> - My moblog. Just like a blog, but with mo'</li>
        <li><a href="http://gallery.scottsmitelli.com/" rel="external">Photo Gallery</a> - Pictures of things</li>
        <li><a href="http://twitter.com/smitelli" rel="external">@smitelli on Twitter</a> - You kids enjoy twittering and whatnot, right?</li>
        <li><a href="http://www.facebook.com/pages/Trigger-and-Freewheel/47703583859" rel="external">Trigger and Freewheel's Facebook page</a> - Become a fan and I'll FTP you a free sandwich! (offer not valid)</li>
        <li><a href="http://www.youtube.com/user/vipersniper32" rel="external">My YouTube channel</a> - Eh, why the hell not?</li>
      </ul>
      <br />
      And if you <em>really</em> enjoyed the work I do, you'd click this little button:<br />
      <a href="{$app->config->app_uri}/donate"><img src="{$app->config->static_uri}/button-donate.png" alt="Donate" /></a>
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">What do you use to draw the comic?</div>
      The bulk of the material on this site was drawn directly into Photoshop CS-something-or-other with a Wacom Bamboo MTE-450. That's right, the cheap one. All the line art, fills, and text are created within Photoshop. I prefer to do the drawing on a Mac, but I've been known to use a Windows laptop if I find myself traveling somewhere. Occasionally I'll use screenshots from other pieces of software to help convey a joke (you'll find I use Adobe Audition a lot for that - partly because I used to stare at that UI every day). I've also been known to trace pictures of real-life objects, like cars for example. Those are notoriously hard to draw without some guidance.
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">What about this website? What did you use to make that?</div>
      I used my bare hands. Oh, and PSPad on Windows.<br />
      <br />
      I hand-coded everything here from scratch: the archive system, the database stuff, the HTML templates, the stylesheets - everything. The graphics were created in Photoshop, then prepared for the web with IrfanView.
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">You're not funny and you can't draw and I don't like you.</div>
      Duly noted.
    </div>
    <div class="postbottom"></div>

    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">default:</div>
      Uh, <code>break;</code>?
    </div>
    <div class="postbottom"></div>
  </div>
  <!-- query count={$comics->get_query_count()}, query msec={$comics->get_query_timer()} -->
{/block}
