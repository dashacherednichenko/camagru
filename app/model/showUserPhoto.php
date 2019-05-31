<?php
function showUserPhotos($email)
{
//        require_once "app/model/newpassword.php";
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $email && $row['activation'] == 1) {
            $id = $row['id'];
//            echo $id;
            $photos = $pdo->prepare('SELECT filename, author, id, date FROM photos WHERE author = ? ORDER BY date DESC');
            $photos->execute([$id]);
            $count = 0;
            foreach ($photos as $rowphoto) {
                $count++;
                echo "<div class='gallery_photo'><img src=".$rowphoto['filename']." class='gallery_photos' id=".$rowphoto['id'].">
                    <div class='likes_block'><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAB4AAAAeABBeqfSQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAOISURBVEiJrdZPTFxVFMfx77nvCZigIbYESOsfmlpm+hhAE1IHSjKpCwlYY2po1S5caFyYLppUtyamidHUuNFE0qjVjataY1RYGHWaQilVUmbgUWgmLaUTmtZWG/4of2bucTFvlKCA0Pmt3rv3vvM59yXvj7BGPC9WijO3x6rEEB5GqQJAuI5y1YjGyZb86PvxmdXqyEoTO+ujj6nlDeA5oGiNfhYEToqVY75/dvB/QZ4XK7Vm/kPgpWAoI6JnsNJljY4ZuKk4omTLBQmhtAG7ATdXUD5zZeZQMpmcXRHaEdm9zSHbBdQAfwKdi2LfTyX706ttp7a28cEs7hGEV4F7BUYzOO2Xhnou/wvaUR/d4ljOANWKJhyrL/p+/8hqwPLsrG/21NovgDqBy1nXtIxd6J0EMMEaYyxfAdVAX5H80bxeBGAk0esbW9wM9CtsMxl7Km8YgFCk6RWBRmDCxWlffn/XE9+PzxhLm0Ia2BWKNL0MIHR0OOHR9DWgSpBnR4bOfr1RZGlCtU/sE5EvgcmLoa0PiVcXbbVKNzB8cagvUggkn3AkOgx4qvKUsZZWAFU9WUgkyCkAEW01CI/kTiRRaEVV8w9vtQEqA/V6oSHEBDW10gC3ANSazQWHVDcFR78ZVCYAMLq90I4YtgMocs0o2pXT2V9oCNUDACISN5m5su+B34Go5zU1FMrwvKZGkF3ArMkWfWtSqe550KOAZI0ep6PDuVskFou51mgnICp85PvxGQNQsankA+AXgcbwaPoT/nkHbiTmxu25E8DjwISTLX4LwAEYHx+3ZZVbuh3kANBSXrHVuXUz/dN6Bc+LlW6urDoBchCYNoa9/lDPFZZ2nkr2pwWO5s7EW6chodro02rmfwZeAKZV9Rk/0Xc+v8BdulphL4CIJJdXqqlrrjGLZqqiwvl1enpaZmxJuWTsowb2KOwDajVnDhirz/v+udTS6/+GQpHom0A7MJt15Hh+PBxuqcJd/Bi1bbiWG7czQBEGm28u2BNXxeo7olOf+r6/sLxRN/hMvAccBlTRQ2MXeicbGmJlC3buNdXMEZAHgDvkPu/lgA3+giYEekU4XXLPwg8DAwOLK9/buugxUV4PuuoEOY3lSUT3A/cH6z4vdooPDw7G76xUaK1IOBKdAu77jzlF+M6IfddP9PdsFMjHVXhboEOgDFiwMIzKOZzMN6OJ85fuFsjnL21oWRPD+D76AAAAAElFTkSuQmCC\">
                    <img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAB4AAAAeABBeqfSQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAH/SURBVEiJ7ZXPaxNREMc/7236C3ozmghRA0psSIqHImWDh4B4K4J6FLwogsWLgv4TgiBYRBS8KF5E8VQQBEFN7KEIrksSEQNVVBoRRPFHat94aDdd8nNTtwfB72lm3sx85r1d3oP/2gglbHskYdsjYeSp5kA2OxkzWp0TUUeAJGCAiiDXv42qK++KxR9e89GvalorOSGQAjRQRbizNBC58Pr541pHUGbP5D6zbN1DSbTDYK7o5cPGWNqCu0C6XZLAIsKh8stioQWUmpiI6vqgq2BLtyMAPqxOH+uR91EbMq5b/MxqAQCRpcGzASAAWwNAAOJGyxnPaYBEmApQ3J+UavTUvvDO0EHCrnYgCR3k6+kHVcOnyJtWkDAbNkijZtdszxDrMlAPkfOzrsyM51ieUastfNkc3/YLOBAOR86/cuYeeJ7/G1HanbgI3P5rBOpWyXl2yR9ruesAnc7aN1AcWx+Eq2WneIqmv1i3yTWx6NBxkGvrgcQ3DZ1uhkD7HTU0Np47qZAZINKD8VtQ02Wn0HE4q9MCwKfFt/Ox+PaSwBQw0CHtuyh1tOwUbnbr1XVHnjKZ3F6j5T4rF6pf7wVzsOzMzffqEQgEkE7ndhCRR6w8hgBVbay86z5ZCFIfGASQGrfHLHgIiFF6f+XF00o/9X0pmcwPJ5P54Q0D/DP6Aw4dmIIS4SzTAAAAAElFTkSuQmCC\">
                    <a href='account/deletephoto?id=$rowphoto[id]&email=$_SESSION[email]' title='delete photo' onclick='return confirm(\"Are you sure you want to delete this photo?\")'>
                        <img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAB4AAAAeABBeqfSQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAFZSURBVEiJ7ZaxTsJQGIXPuQXdfA5rsIOLwigxjiQOuPkAGjcXB2PkAdx4AB/AxFkTxyKLg0VkVx5AN5H2OJSEWorUpovKmdr/P+d+NzfN7Q/8NTGtcbm0cWrIvWgtAC56XquRCbTilKsSGgAXx1UtAFidsoYHcBDxvhvy5PHBvY2aCvGUpF2AFUBpNopwA1+9vlQHMAP0ERyzYLVFWmlJURlpaISrLNlclPgx2KX1LdBay7Si/PunTvsmXp44uhBvaoAOMoFomgAmQCZVFugBeEtovY56M5UG5Ha9li2Derwhsd71WjaguzxA/dBoXibCFvvhE5/zAOWiOWgO+uegIgBwqGK8wSELUc93SrxUBQYc/8w2baey7wvb8as+MP6Z7VSuIVWj2dQgg6At8HD0ugSpOWW4qEGqRQsk3CTjtOGEtlM+grQDmJnHEkoDiZe9jnuOH8wBv1eficRpaKXz8HAAAAAASUVORK5CYII=\">
                    </a>
                    <span class='date'>".$rowphoto['date']."</span>
                    </div>
                    </div>";
            }
            if ($count == 0)
                echo "<h3>You have no photos yet =(</h3><br><a href='snapchat'>go to snapchat?</a>";
        }
    }


//echo $email;
return true;
}
?>