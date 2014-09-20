@extends('layouts.master')
@section('title')
	Frequently Asked Questions
@stop
@section('content')
	<div class="col-md-12">
		<p>Cornell Forum is pretty simple but if you really want to get the most out of it there are a few tips and tricks to know. On this page we'll cover the most commonly used functions and the most frequently asked questions to help you get the most of your Cornell Forum experience.</p>
		<h3>Formatting your posts and comments:</h3>
		<p>You can format your posts and comments on Cornell Forum using a special flavor of <a target="_blank" href="http://en.wikipedia.org/wiki/BBCode">BBCode</a> You can use the tags:</p>
		<ul>
			<li><code>[b]</code> for bolded text</li>
			<li><code>[i]</code> for italics</li>
			<li><code>[img]</code> for images</li>
			<li><code>[youtube]</code> for YouTube videos</li>
			<li><code>[quote]</code> for quotes</li>
		</ul>
		<p>You use a BBCode tag by wrapping the content you want the tag to apply to inside the tag, just like HTML (if you know HTML). A sample post using BBCode can be written using syntax like this:</p>
		<pre>[b]some bolded text[/b] and then a [youtube]jD9SwJTg-5U[/youtube] video, and then an [img]http://upload.wikimedia.org/wikipedia/commons/d/d9/Black_BMW_M3_CSL_E46_rr.jpg[/img] pic of a BMW m3</pre>
		<h3>Wordfilters, a.k.a. poppycocking slot machines what is this chitty chitty bang bang:</h3>
		<p>You've probably noticed that Cornell Forum has wordfilters. If you write certain words, Cornell Forum will convert them to something else before saving your post. This makes things a bit silly, perpetuates inside jokes and reminds you not to take yourself too seriously. Wordfilters have been around on iterations of Cornell Forum since 2007. They also (sortof) eliminates unsavory words. The list of wordfilters is as follows:</p>
		<ul>
			<li>fugg <i class="fa fa-long-arrow-right"></i> <code>poppycock</code></li>
			<li>shet <i class="fa fa-long-arrow-right"></i> <code>chitty chitty bang bang</code></li>
			<li>sl00t <i class="fa fa-long-arrow-right"></i> <code>slot machine</code></li>
			<li>bundle of sticks|stick <i class="fa fa-long-arrow-right"></i> <code>fratstar</code></li>
		</ul>
		<h3>Commitment to privacy and anonymity:</h3>
		<p>Cornell Forum is an <strong>anonymous forum</strong> and will always be that way. Our privacy and anonymity commitments:</p>
		<ul class="fa-ul">
		 	<li><i class="fa-li fa fa-times-circle"></i> We will never show your login information next to any posts or comments you make. Nobody will be able to find out if you made a post</li>
		 	<li><i class="fa-li fa fa-times-circle"></i> We will never record your IP address or track what you're doing with crap like Google Analytics</li>
		 	<li><i class="fa-li fa fa-times-circle"></i> We will never censor what you have to say as long as it fits within our <a href="#simple-rules">simple rules</a></li>
		 </ul>
		 <p>tl;dr we take your privacy and anonymity very seriously.</p>
		<h3>Simple rules for posting on Cornell Forum:</h3>
		<p>Cornell Forum has four simple, sensible rules that you must abide by when posting:</p>
		<ul class="fa-ul" id="simple-rules">
			<li><i class="fa-li fa fa-check-circle"></i> <strong>Don't be mean</strong>: don't attack your peers and/or write nasty things about other people using their name</li>
			<li><i class="fa-li fa fa-check-circle"></i> <strong>Keep your prejudices at home</strong>: Racists, anti-semites, sexists and misogynists don't belong here</li>
			<li><i class="fa-li fa fa-check-circle"></i> <strong>Safe for work:</strong> no porn or NSFW content, please</li>
			<li><i class="fa-li fa fa-check-circle"></i> <strong>Add some value:</strong> don't repost low-quality content from 4chan, Reddit or the Misc</li>
		</ul>
		<p>Other than that, you're good to go. If you consistently don't follow these rules, we'll have to remove your ability to post by deactivating your account.</p>
		<h3>Why can't I downvote threads?</h3>
		<p>Your account needs to be at least 30 days old before you can downvote threads.</p>
		<h3>Where do I upload images I want to post?</h3>
		<p>Cornell Forum only allows externally-hosted images. If you're looking for a place to upload your images, we can recommend:</p>
		<ul>
			<li><a target="_blank" href="http://imgur.com">http://imgur.com</a></li>
			<li><a target="_blank" href="http://min.us">http://min.us</a></li>
		</ul>
		<h3>Open source, free as in freedom and community-driven:</h3>
		<p>Cornell Forum is free as in freedom, open source, driven by the Cornell community and always will be that way. Cornell Forum does not display ads or make money. Cornell Forum exists solely to provide a high-quality place for Cornellians to talk about whatever is on their minds. You can submit pull requests and view our source code on <a target="_blank" href="https://github.com/wnajar/cornellforum">GitHub</a>. Thanks for coming to Cornell Forum!</p>
		<iframe src="http://gfycat.com/ifr/HalfSmugAmericancicada" frameborder="0" scrolling="no" width="235" height="240" style="-webkit-backface-visibility: hidden;-webkit-transform: scale(1);" ></iframe>
	</div>
@stop
