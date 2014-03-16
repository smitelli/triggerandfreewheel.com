    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">Comic Upload</div>
      <form action="{$app->self_uri|escape:htmlall}" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <th style="text-align:right;">Date:</th>
            <td><input type="text" name="post_date" value="{if isset($smarty.post.post_date)}{$smarty.post.post_date|escape:htmlall}{else}{$admin->next_date()}{/if}" style="width:500px;" /></td>
          </tr>
          <tr>
            <th style="text-align:right;">Title:</th>
            <td><input type="text" name="post_title" value="{if isset($smarty.post.post_title)}{$smarty.post.post_title|escape:htmlall}{/if}" style="width:500px;" /></td>
          </tr>
          <tr>
            <th style="text-align:right;">Body:</th>
            <td><textarea name="post_body" cols="60" rows="10" style="width:500px; height:200px;">{if isset($smarty.post.post_body)}{$smarty.post.post_body|escape:htmlall}{/if}</textarea></td>
          </tr>
          <tr>
            <th style="text-align:right;">Permalink:</th>
            <td><input type="text" name="post_permalink" value="{if isset($smarty.post.post_permalink)}{$smarty.post.post_permalink|escape:htmlall}{/if}" style="width:500px;" /></td>
          </tr>
          <tr>
            <th style="text-align:right;">Image:</th>
            <td>
              <div style="float:right;"><input type="submit" name="post_submit" value="Post" /></div>
              <input type="file" name="post_image" />
            </td>
          </tr>
        </table>
      </form>
      <script type="text/javascript">/* <![CDATA[ */
        $('input[name="post_title"]').bind('keyup', function() {
          str = $('input[name="post_title"]').val().toLowerCase();
          out = '';
          prev = '';
          for (i=0; i<str.length; i++) {
            cc = str.charCodeAt(i);
            ch = str.charAt(i)
            if ((cc >= 97 && cc <= 122) || cc >= 48 && cc <= 57) {  //a-z, 0-9
              out = out + ch;
              prev = ch;
            } else if (ch == ' ' || ch == '/' || ch == '-') {  //sp, /, -
              if (prev != '-') out = out + '-';
              prev = '-';
            }
          }
          $('input[name="post_permalink"]').val(out);
        });
      /* ]]> */</script>
      <p>
        There are currently {$admin->row_count()} comics in the DB.<br />
        <a href="{$app->self_uri|escape:htmlall}">Reset this mess</a>.
      </p>
    </div>
    <div class="postbottom"></div>

<!--
<strong>TnF Standard</strong>
PNG-8
Perceptual
Diffusion
No transparency
No interlacing
256 colors
100% dither
No matte
0% web snap
Bicubic resize quality

<strong>TnF JPEG</strong>
JPEG
Very High
No progressive
No icc profile
Yes optimized
80 quality
0 blur
No matte
Bicubic resize quality
-->