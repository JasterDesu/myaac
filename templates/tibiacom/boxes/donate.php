<style>
    .donate{
        width: 180px;
        height: 210px;
    }
    .donate_header{
        height: 32px;
        width: 180px;
        background-image: url('templates/tibiacom/images/themeboxes/donate_box_top.png');
        font-family: Verdana;
        font-weight: bold;
        color: #d5c3af;
        line-height: 35px;
    }
    .donate_bottom{
        height: 26px;
        position: absolute;
        width: 180px;
        margin-top: -24px;
        margin-left: 31px;
        background-image: url('templates/tibiacom/images/themeboxes/button_tibia_coins.png');
    }
    .donate_content{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        width: 160px;
        height: 133px;
        background-image: url('templates/tibiacom/images/themeboxes/donate_box_bg.png');
        display: grid;
        justify-content: center;
        align-items: center;
    }
    .donate_outfit{
        position: absolute;
        width: 64px;
        height: 64px;
        background-position: bottom right;
        left: 10px;
        margin-top: -15px;
    }
    .donate_text{
        margin-left: 45px;
        font-family: Verdana;
        color: #d5c3af;
        text-align: left;
    }
    .donate_button{
        height: 34px;
        width: 142px;
        border: 0;
        background: url('templates/tibiacom/images/themeboxes/get_coins.png');
        font-family: Verdana;
        font-weight: 100;
        color: #d5c3af;
        font-size: 12px;
        cursor: pointer;
        margin-left: 9px;
        margin-top: -4px;
    }
    .donate_button:hover{
        background: url('templates/tibiacom/images/themeboxes/get_coins_hover.png');
        color: #fff;
    }
</style>
<div class="donate">
    <div class="donate_header"></div>
    <div class="donate_content">
        <div>
            <img src="templates/tibiacom/images/themeboxes/k_coins.gif">
        </div>
        <a href="?subtopic=donate"><div type="button" class="donate_button"></div></a>
    </div>
    <div class="donate_bottom"></div>
</div>
