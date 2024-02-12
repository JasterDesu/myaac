<style>
    @font-face {
      font-family: Martel;
      src: url(/templates/tibiacom/martel.ttf);
    }
    .serverinfo_box{
        width: 180px;
        max-height: 360px;
    }
    .serverinfo_box_header{
        height: 32px;
        width: 180px;
        background-image: url('templates/tibiacom/images/themeboxes/serverinfo_box-top.png');
        font-family: Martel;
        color: white;
        line-height: 35px;
    }
    .serverinfo_box_bottom{
        height: 30px;
        width: 180px;
        /* margin-top: -20px; */
        background-image: url('templates/tibiacom/images/themeboxes/box-bottom.gif');
    }
    .serverinfo_box_content{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        width: 160px;
        max-height: 290px;
        background-image: url('templates/tibiacom/images/themeboxes/box_bg.png');
    }
    .serverinfo_box_player{
        font-family: Verdana;
        color: #d5c3af;
        text-align: left;
        display: flex;
        align-items: center;
        padding: 10px 5px;
    }
    .serverinfo_box_outfit{
        position: absolute;
        width: 64px;
        height: 64px;
        background-position: bottom right;
        left: -15px;
        margin-top: -30px;
    }
    .rank_text{
        margin-left: 45px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    .rank_text a{
        text-decoration: none;
        color: #d5c3af;
    }
    .serverinfo_box_button{
        height: 30px;
        width: 148px;
        border: 0;
        background: url('templates/tibiacom/images/themeboxes/button.png');
        font-family: Verdana;
        font-weight: 100;
        color: #d5c3af;
        font-size: 12px;
        cursor: pointer;
    }

    .serverinfo_box_button:hover{
        background: url('templates/tibiacom/images/themeboxes/button_over.png');
        color: #fff;
    }
</style>
<div class="serverinfo_box">
    <div class="serverinfo_box_header"></div>
    <div class="serverinfo_box_content">
      <a href="?serverInfo">
      <img src="templates/tibiacom/images/themeboxes/server_info_bg.png" />
      </a>
    </div>
    <div class="serverinfo_box_bottom"></div>
</div>