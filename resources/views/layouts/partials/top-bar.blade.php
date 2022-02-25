<div id="top-bar">
	<div id="container">
    	<div id="top-left">APRIL 15 - 17,2022/MAMA NGINA WATERFRONT MOMBASA.</div>
        <div id="top-right">
        	<a href="#" class="youtube"></a>
            <a href="#" class="instagram"></a>
            <a href="#" class="facebook"></a>
            <a href="#" class="twitter"></a> 
            @if(Auth::check())
                <a style="display:none;" href="/register">REGISTER</a>
                <a style="display:none;" href="/login">LOGIN &nbsp;|&nbsp;</a>
            @else
                <a  href="/register">REGISTER</a>
                <a  href="/login">LOGIN &nbsp;|&nbsp;</a>
            @endif
        </div> <!--==end of <div id="top-right"> ==-->
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="top-bar">==-->