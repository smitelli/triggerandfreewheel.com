    <div class="posttop"></div>
    <div class="post">
      <div class="posttitle">Log In</div>
      <form action="{$app->self_uri|escape:htmlall}" method="post">
        <table>
          <tr>
            <th class="r">User Name:</th>
            <td><input type="text" name="login_name" value="{if isset($smarty.post.login_name)}{$smarty.post.login_name|escape:htmlall}{/if}" /></td>
          </tr>
          <tr>
            <th class="r">Password:</th>
            <td><input type="password" name="login_pass" value="" /></td>
          </tr>
          <tr>
            <td></td>
            <td class="r"><input type="submit" value="Log In" /></td>
          </tr>
        </table>
      </form>
    </div>
    <div class="postbottom"></div>