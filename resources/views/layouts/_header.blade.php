<header class="navbar navbar-fixed-top navbar-default">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse"
    data-target="#default-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/share" id="logo">中国模具网</a>
        </div>
      <nav class="collapse navbar-collapse" id="default-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('share.index') }}"><i class="fa fa-share" aria-hidden="true"></i> 分享</a></li>
            <li><a href="{{ route('lottery.index') }}"><span class="glyphicon glyphicon-gift"></span> 抽奖</a></li>
            <li><a href="{{ route('prize.index') }}"><span class="glyphicon glyphicon-user"></span> 我的奖品</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>
