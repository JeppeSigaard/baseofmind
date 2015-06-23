<form id="smamo-ct">
    <div>
        <label id="lbl-name" for="ct-name" placeholder="Skriv dit navn her" >Navn</label><br/>
        <input type="text" id="ct-name" name="ct-name" autocomplete="on"/><br/>

        <label id="lbl-email" for="ct-email" placeholder="">Din email</label><br/>
        <input type="email" id="ct-email" name="ct-email" autocomplete="on"/><br/>
    </div>
    <div>
        <label id="lbl-message" for="ct-message" placeholder="Skriv en besked her">Din besked</label><br/>
        <textarea id="ct-message" name="ct-message"></textarea><br/>
    </div>
    <a href="#" id="ct-submit">Send</a>
    <input type="hidden" id="ct-auth" name="ct-auth" value="gwæefUUweuhuwhfWUEFFWWEF"/>
    <input type="hidden" id="ct-to" name="ct-to" value="<?php echo $email ?>"/>
</form>