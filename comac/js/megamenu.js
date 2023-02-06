.mega-dropdown{
    .mega-dropdown-menu{
        > li{
            float:left;
            width:100%;
        }
    }
}

 
 
 .mega-dropdown-menu {
    padding: 20px;
    width: 100%;
    box-shadow: none;
    -webkit-box-shadow: none;
    border: 0px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
    >li>ul {
        padding: 0;
        margin: 0;
        >li {
            list-style: none;
            >a {
                display: block;
                padding: 8px 0px;
                clear: both;
                line-height: 1.428571429;
                color: @bodytext;
                white-space: normal;
                &:hover,
                &:focus {
                    text-decoration: none;
                    color: @themecolor;
                }
            }
        }
    }
 
 .mega-dropdown-menu li.demo-box a {
    color: @white;
    display: block;
    &:hover {
        opacity: 0.8;
    }
}

 
 .mega-dropdown-menu {
 height: 340px;
overflow: auto;}