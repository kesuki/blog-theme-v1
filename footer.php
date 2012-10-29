<?php
/*
Theme Name: mak
Version: 4
File Name: footer.php
*/
?>
	<div id="footer">
			<div class="footerdiv"></div>
			<div class="cpyBot">
				Copyright &copy; 2009-2012 <a href="<?php bloginfo('url'); ?>">Mak</a> | 
				采用<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/cn/ rel="external nofollow">知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议</a>进行许可。
			</div>
			<div class="cpyBot">
				Loading <strong style="color:#CD1F1F"><?php echo get_num_queries(); ?></strong> queries, <strong style="color:#CD1F1F"><?php timer_stop(1); ?></strong> seconds
<?php
if ( function_exists('wp_gzip') ) { ?><strong style="color:#94a">Gzipped</strong><?php } // 啟用 gzip 才出現
?>
				 | Theme by <a href="http://www.mak-blog.com" target="_blank" title="Mak's Themes" rel="external nofollow">Mak</a>
				 | Powered by <a href="http://wordpress.org" target="_blank" title="WordPress.org" rel="external nofollow">WordPress</a>
				 | Hosted on <a href="http://www.100host.net/" target="_blank" title="衡天主机" rel="external nofollow">HengTian</a>
				 | Statistics by <a href="http://www.google.com/analytics/" target="_blank" title="Google Analytics" rel="external nofollow">Google</a>
			</div>
			<div class="clear"></div>		
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	if($('.post a[rel!=link]:has(img)').length > 0){
		$.getScript("<?php bloginfo('template_url'); ?>/js/slimbox2.js");
	};
});
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>

//baidu
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1c983a79981803c645e1f201195d0fdc' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<?php if( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/comments-ajax.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#comments .comment-body').dblclick(function(){
		var crl=$('#cancel-comment-reply-link');
		if($(this).next('#respond').length > 0) {crl.click()
		}else{$(this).find('.comment-reply-link').click();crl.text("取消 @"+$(this).find('.name').text());
		}
		return false
	});
	$('#comments .live').live('dblclick',function(){$(this).next().children('a').click()});
});
</script>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>