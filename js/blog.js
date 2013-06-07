(function ($) {
	$(document).ready(function() {
		
		//$("#Body .row-fluid > div").equalHeights(); 

		if($(".sidebar .twitter-section").length > 0) {
			// Adding Twitter Feed
			var jsont = document.createElement('script'),
				twarget = $(".sidebar .twitter-section")[0];
			jsont.setAttribute('src', '//api.twitter.com/1/statuses/user_timeline/aeekay.json?count=1&callback=twitterResults');

			window.twitterResults = function(o) {
				jsont.parentNode.removeChild(jsont);
				var twitter_list = $("<ul></ul>");

				$.each(o, function(index, item) {
					var tweet_item = $("<div></div>").addClass('tweet').append($("<img/>").addClass('profile-pic').attr("src", item.user.profile_image_url).attr("alt", item.user.name));
					var content_item = $("<div></div>").addClass('content'); 
					var header_item = $("<h4></h4>").append($("<a></a>").attr("href", "//twitter.com/" + item.user.screen_name).text('@' + item.user.screen_name));
					header_item.append($("<span></span>").addClass("time").text(relative_time(item.created_at)));
					content_item.append(header_item);
					content_item.append($("<div></div>").addClass("tweetdet")); 
					var span = $(content_item).find(".tweetdet")[0];
					span.innerHTML = item.text.replace(/(\b(https?|ftp|file):\/\/[\-A-Z0-9+&@#\/%?=~_|!:,.;]*[\-A-Z09+&@#\/%=~_|])/img, '<a href="$1" target="_blank">$1</a>');
					var utility_links = $("<ul></ul>").addClass("utility");
					utility_links.append($("<li></li>").addClass("expand").append($("<a></a>").attr("target", "_blank").attr("href", "https://twitter.com/"+item.user.screen_name+"/status/" + item.id_str).text("Expand")));
					utility_links.append($("<li></li>").addClass("reply").append($("<a></a>").attr("target", "_blank").attr("href", "https://twitter.com/intent/tweet?in_reply_to=" + item.id_str).text("Reply")));
					utility_links.append($("<li></li>").addClass("retweet").append($("<a></a>").attr("target", "_blank").attr("href", "https://twitter.com/intent/retweet?tweet_id=" + item.id_str).text("Retweet")));
					utility_links.append($("<li></li>").addClass("favorite").append($("<a></a>").attr("target", "_blank").attr("href", "https://twitter.com/intent/favorite?tweet_id=" + item.id_str).text("Favorite")));
					$(content_item).append(utility_links);
					$(content_item).append($("<div></div>").addClass("clearfix"));
					$(tweet_item).append(content_item);
					$(twarget).append(tweet_item); 
				});

				
			}
			
			document.body.appendChild(jsont);
		}

		if($("body.sub").length > 0) {
			$("#Content-Right .instagram-photos").unslider({ dots: true, speed: 3000, delay: 5000});
		}
	});

	function relative_time(date_str) {
	    if (!date_str) {return;}
	    date_str = $.trim(date_str);
	    date_str = date_str.replace(/\.\d\d\d+/,""); // remove the milliseconds
	    date_str = date_str.replace(/-/,"/").replace(/-/,"/"); //substitute - with /
	    date_str = date_str.replace(/T/," ").replace(/Z/," UTC"); //remove T and substitute Z with UTC
	    date_str = date_str.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"); // +08:00 -> +0800
	    var parsed_date = new Date(date_str);
	    var relative_to = (arguments.length > 1) ? arguments[1] : new Date(); //defines relative to what ..default is now
	    var delta = parseInt((relative_to.getTime()-parsed_date)/1000);
	    delta=(delta<2)?2:delta;
	    var r = '';
	    if (delta < 60) {
	    r = delta + ' seconds ago';
	    } else if(delta < 120) {
	    r = 'a minute ago';
	    } else if(delta < (45*60)) {
	    r = (parseInt(delta / 60, 10)).toString() + ' minutes ago';
	    } else if(delta < (2*60*60)) {
	    r = 'an hour ago';
	    } else if(delta < (24*60*60)) {
	    r = '' + (parseInt(delta / 3600, 10)).toString() + ' hours ago';
	    } else if(delta < (48*60*60)) {
	    r = 'a day ago';
	    } else {
	    r = (parseInt(delta / 86400, 10)).toString() + ' days ago';
	    }
	    return 'about ' + r;
	};
}(jQuery))