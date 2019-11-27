@include ("showposts")

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .button {
        font: bold 11px Arial;
        text-decoration: none;
        background-color: #EEEEEE;
        color: #333333;
        padding: 2px 6px 2px 6px;
        border-top: 1px solid #CCCCCC;
        border-right: 1px solid #333333;
        border-bottom: 1px solid #333333;
        border-left: 1px solid #CCCCCC;
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/jquery.jscroll.min.js"></script>


<html>

    <head>

    </head>

    <body>
        <div align="middle">
            <div class="dropdown" align="middle">
                <span>Sort by</span>
                <div class="dropdown-content" >
                    <div>
                        <a class="button" href="/index/1">
                            Hot
                        </a>
                    </div>
                        <br>
                    <div>
                        <a class="button" href="/index/2">
                            Top
                        </a>
                    </div>
                        <br>
                    <div>
                        <a class="button" href="/index/3">
                            New
                        </a>
                    </div>
                        <br>
                    <div>
                        <a class="button" href="/index/4">
                            Rising
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="infinite-scroll">
                @stack("load")

        </div>
        @if(1)
            <a class="button" href="/index/{{$sorting}}/{{($response[0]->data->name)}}/before">Previous</a>
        @endif
        @if (1)
            <a class="button" href="/index/{{$sorting}}/{{$after}}/after">Next</a>
        @endif
    
    </body>
</html>



