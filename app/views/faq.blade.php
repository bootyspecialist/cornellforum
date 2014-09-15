@extends('layouts.master')
@section('title')
	Frequently Asked Questions
@stop
@section('content')
	<p>Cornell Forum is pretty simple, but if you really want to get the most out of it there are a few tips and tricks to know. On this page we'll cover the most commonly used functions to help you get the most of your Cornell Forum experience. We'll also cover the most frequently asked questions.</p>
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
	<h3>Commitment to privacy and anonymity:</h3>
	<p>Cornell Forum is an <strong>anonymous forum</strong> and will always be that way. Our privacy and anonymity commitment to you:</p>
	<ol>
	 	<li>We will never show your login information next to any posts or comments you make. Nobody will be able to find out if you made a post</li>
	 	<li>We will never record your IP address or track what you're doing with crap like Google Analytics</li>
	 	<li>We will never censor what you have to say as long as it fits within our <a href="#rules">simple rules</a></li>
	 </ol>
	 <p>tl;dr we take your privacy and anonymity very seriously.</p>
	<h3>Wordfilters, a.k.a. poppycocking slot machines what is this chitty chitty bang bang:</h3>
	<p>You've probably noticed that Cornell Forum has wordfilters. If you write certain words, Cornell Forum will convert them to something else before saving your post. This makes things a silly, perpetuates inside jokes and reminds you not to take yourself too seriously. Wordfilters have been around on iterations of Cornell Forum since 2007. They also (sortof) eliminates unsavory words. The list of wordfilters is as follows:</p>
	<ul>
		<li>fugg <i class="fa fa-long-arrow-right"></i> <code>poppycock</code></li>
		<li>shet <i class="fa fa-long-arrow-right"></i> <code>chitty chitty bang bang</code></li>
		<li>salute <i class="fa fa-long-arrow-right"></i> <code>slot machine</code></li>
		<li>bundle of sticks|bundle of stick <i class="fa fa-long-arrow-right"></i> <code>fratstar</code></li>
	</ul>
	<h3>Simple rules for posting on Cornell Forum:</h3>
	<p>Cornell Forum has a few sensible rules that you must abide by when posting:</p>
	<ol>
		<li>Don't attack your peers and/or write nasty things about other people using their name</li>
		<li>Racists and anti-semites don't belong here</li>
		<li>Sexists and misogynists don't belong here</li>
		<li>No porn, please</li>
		<li>Don't repost low-quality content from 4chan, Reddit or the Misc</li>
	</ol>
	<p>If you consistently don't follow these rules, we'll have to remove your ability to post by deactivating your account.</p>
	<h3>Open source and community-driven:</h3>
	<p>Cornell Forum is free, open source, driven by the Cornell community and always will be that way. Cornell Forum does not display ads or make money. Cornell Forum exists solely to provide a high-quality place for Cornellians to talk about whatever is on their minds. You can submit pull requests and view our source code on <a target="_blank" href="https://github.com/wnajar/cornellforum">GitHub</a>. Thanks for coming to Cornell Forum!</p>
	<iframe src="http://gfycat.com/ifr/HalfSmugAmericancicada" frameborder="0" scrolling="no" width="235" height="240" style="-webkit-backface-visibility: hidden;-webkit-transform: scale(1);" ></iframe>
@stop
