<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
      
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
      <style>
          @charset "UTF-8";
/* custom CSS files */

.vegas-overlay,.vegas-slide,.vegas-slide-inner,.vegas-timer,.vegas-wrapper{position:absolute;top:0;left:0;bottom:0;right:0;overflow:hidden;border:none;padding:0;margin:0}.vegas-overlay{opacity:.5;background:url(overlays/02.png) center center}.vegas-timer{top:auto;bottom:0;height:2px}.vegas-timer-progress{width:0;height:100%;background:#fff;-webkit-transition:width ease-out;transition:width ease-out}.vegas-timer-running .vegas-timer-progress{width:100%}.vegas-slide,.vegas-slide-inner{margin:0;padding:0;background:center center no-repeat;-webkit-transform:translateZ(0);transform:translateZ(0)}body .vegas-container{overflow:hidden!important;position:relative}.vegas-video{min-width:100%;min-height:100%;width:auto;height:auto}body.vegas-container{overflow:auto;position:static;z-index:-2}body.vegas-container>.vegas-overlay,body.vegas-container>.vegas-slide,body.vegas-container>.vegas-timer{position:fixed;z-index:-1}:root body.vegas-container>.vegas-overlay,:root body.vegas-container>.vegas-slide,_::full-page-media,_:future{bottom:-76px}.vegas-transition-blur,.vegas-transition-blur2{opacity:0;-webkit-filter:blur(32px);filter:blur(32px)}.vegas-transition-blur-in,.vegas-transition-blur2-in{opacity:1;-webkit-filter:blur(0);filter:blur(0)}.vegas-transition-blur2-out{opacity:0}.vegas-transition-burn,.vegas-transition-burn2{opacity:0;-webkit-filter:contrast(1000%) saturate(1000%);filter:contrast(1000%) saturate(1000%)}.vegas-transition-burn-in,.vegas-transition-burn2-in{opacity:1;-webkit-filter:contrast(100%) saturate(100%);filter:contrast(100%) saturate(100%)}.vegas-transition-burn2-out{opacity:0;-webkit-filter:contrast(1000%) saturate(1000%);filter:contrast(1000%) saturate(1000%)}.vegas-transition-fade,.vegas-transition-fade2{opacity:0}.vegas-transition-fade-in,.vegas-transition-fade2-in{opacity:1}.vegas-transition-fade2-out{opacity:0}.vegas-transition-flash,.vegas-transition-flash2{opacity:0;-webkit-filter:brightness(25);filter:brightness(25)}.vegas-transition-flash-in,.vegas-transition-flash2-in{opacity:1;-webkit-filter:brightness(1);filter:brightness(1)}.vegas-transition-flash2-out{opacity:0;-webkit-filter:brightness(25);filter:brightness(25)}.vegas-transition-negative,.vegas-transition-negative2{opacity:0;-webkit-filter:invert(100%);filter:invert(100%)}.vegas-transition-negative-in,.vegas-transition-negative2-in{opacity:1;-webkit-filter:invert(0);filter:invert(0)}.vegas-transition-negative2-out{opacity:0;-webkit-filter:invert(100%);filter:invert(100%)}.vegas-transition-slideDown,.vegas-transition-slideDown2{-webkit-transform:translateY(-100%);transform:translateY(-100%)}.vegas-transition-slideDown-in,.vegas-transition-slideDown2-in{-webkit-transform:translateY(0);transform:translateY(0)}.vegas-transition-slideDown2-out{-webkit-transform:translateY(100%);transform:translateY(100%)}.vegas-transition-slideLeft,.vegas-transition-slideLeft2{-webkit-transform:translateX(100%);transform:translateX(100%)}.vegas-transition-slideLeft-in,.vegas-transition-slideLeft2-in{-webkit-transform:translateX(0);transform:translateX(0)}.vegas-transition-slideLeft2-out,.vegas-transition-slideRight,.vegas-transition-slideRight2{-webkit-transform:translateX(-100%);transform:translateX(-100%)}.vegas-transition-slideRight-in,.vegas-transition-slideRight2-in{-webkit-transform:translateX(0);transform:translateX(0)}.vegas-transition-slideRight2-out{-webkit-transform:translateX(100%);transform:translateX(100%)}.vegas-transition-slideUp,.vegas-transition-slideUp2{-webkit-transform:translateY(100%);transform:translateY(100%)}.vegas-transition-slideUp-in,.vegas-transition-slideUp2-in{-webkit-transform:translateY(0);transform:translateY(0)}.vegas-transition-slideUp2-out{-webkit-transform:translateY(-100%);transform:translateY(-100%)}.vegas-transition-swirlLeft,.vegas-transition-swirlLeft2{-webkit-transform:scale(2) rotate(35deg);transform:scale(2) rotate(35deg);opacity:0}.vegas-transition-swirlLeft-in,.vegas-transition-swirlLeft2-in{-webkit-transform:scale(1) rotate(0);transform:scale(1) rotate(0);opacity:1}.vegas-transition-swirlLeft2-out,.vegas-transition-swirlRight,.vegas-transition-swirlRight2{-webkit-transform:scale(2) rotate(-35deg);transform:scale(2) rotate(-35deg);opacity:0}.vegas-transition-swirlRight-in,.vegas-transition-swirlRight2-in{-webkit-transform:scale(1) rotate(0);transform:scale(1) rotate(0);opacity:1}.vegas-transition-swirlRight2-out{-webkit-transform:scale(2) rotate(35deg);transform:scale(2) rotate(35deg);opacity:0}.vegas-transition-zoomIn,.vegas-transition-zoomIn2{-webkit-transform:scale(0);transform:scale(0);opacity:0}.vegas-transition-zoomIn-in,.vegas-transition-zoomIn2-in{-webkit-transform:scale(1);transform:scale(1);opacity:1}.vegas-transition-zoomIn2-out,.vegas-transition-zoomOut,.vegas-transition-zoomOut2{-webkit-transform:scale(2);transform:scale(2);opacity:0}.vegas-transition-zoomOut-in,.vegas-transition-zoomOut2-in{-webkit-transform:scale(1);transform:scale(1);opacity:1}.vegas-transition-zoomOut2-out{-webkit-transform:scale(0);transform:scale(0);opacity:0}.vegas-animation-kenburns{-webkit-animation:kenburns ease-out;animation:kenburns ease-out}@-webkit-keyframes kenburns{0%{-webkit-transform:scale(1.5);transform:scale(1.5)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes kenburns{0%{-webkit-transform:scale(1.5);transform:scale(1.5)}100%{-webkit-transform:scale(1);transform:scale(1)}}.vegas-animation-kenburnsDownLeft{-webkit-animation:kenburnsDownLeft ease-out;animation:kenburnsDownLeft ease-out}@-webkit-keyframes kenburnsDownLeft{0%{-webkit-transform:scale(1.5) translate(10%,-10%);transform:scale(1.5) translate(10%,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsDownLeft{0%{-webkit-transform:scale(1.5) translate(10%,-10%);transform:scale(1.5) translate(10%,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsDownRight{-webkit-animation:kenburnsDownRight ease-out;animation:kenburnsDownRight ease-out}@-webkit-keyframes kenburnsDownRight{0%{-webkit-transform:scale(1.5) translate(-10%,-10%);transform:scale(1.5) translate(-10%,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsDownRight{0%{-webkit-transform:scale(1.5) translate(-10%,-10%);transform:scale(1.5) translate(-10%,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsDown{-webkit-animation:kenburnsDown ease-out;animation:kenburnsDown ease-out}@-webkit-keyframes kenburnsDown{0%{-webkit-transform:scale(1.5) translate(0,-10%);transform:scale(1.5) translate(0,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsDown{0%{-webkit-transform:scale(1.5) translate(0,-10%);transform:scale(1.5) translate(0,-10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsLeft{-webkit-animation:kenburnsLeft ease-out;animation:kenburnsLeft ease-out}@-webkit-keyframes kenburnsLeft{0%{-webkit-transform:scale(1.5) translate(10%,0);transform:scale(1.5) translate(10%,0)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsLeft{0%{-webkit-transform:scale(1.5) translate(10%,0);transform:scale(1.5) translate(10%,0)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsRight{-webkit-animation:kenburnsRight ease-out;animation:kenburnsRight ease-out}@-webkit-keyframes kenburnsRight{0%{-webkit-transform:scale(1.5) translate(-10%,0);transform:scale(1.5) translate(-10%,0)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsRight{0%{-webkit-transform:scale(1.5) translate(-10%,0);transform:scale(1.5) translate(-10%,0)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsUpLeft{-webkit-animation:kenburnsUpLeft ease-out;animation:kenburnsUpLeft ease-out}@-webkit-keyframes kenburnsUpLeft{0%{-webkit-transform:scale(1.5) translate(10%,10%);transform:scale(1.5) translate(10%,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsUpLeft{0%{-webkit-transform:scale(1.5) translate(10%,10%);transform:scale(1.5) translate(10%,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsUpRight{-webkit-animation:kenburnsUpRight ease-out;animation:kenburnsUpRight ease-out}@-webkit-keyframes kenburnsUpRight{0%{-webkit-transform:scale(1.5) translate(-10%,10%);transform:scale(1.5) translate(-10%,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsUpRight{0%{-webkit-transform:scale(1.5) translate(-10%,10%);transform:scale(1.5) translate(-10%,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}.vegas-animation-kenburnsUp{-webkit-animation:kenburnsUp ease-out;animation:kenburnsUp ease-out}@-webkit-keyframes kenburnsUp{0%{-webkit-transform:scale(1.5) translate(0,10%);transform:scale(1.5) translate(0,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}@keyframes kenburnsUp{0%{-webkit-transform:scale(1.5) translate(0,10%);transform:scale(1.5) translate(0,10%)}100%{-webkit-transform:scale(1) translate(0,0);transform:scale(1) translate(0,0)}}
/*# sourceMappingURL=vegas.min.css.map */
@import url(vegas.min.css);
/* Google Fonts */
@import url("https://fonts.googleapis.com/css?family=Montserrat|Open+Sans");
/*
* http://meyerweb.com/eric/tools/css/reset/ 
* v2.0 | 20110126
* License: none (public domain)
*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}

/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section, main {
  display: block;
}

body {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

blockquote, q {
  quotes: none;
}

blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

/* ------------------------------------- */
/* 1. Generic styles ................... */
/* ------------------------------------- */
html {
  font-size: 62.5%;
}

body {
  background: #1F222E;
  font-family: "Open Sans", "Helvetica Neue", "Lucida Grande", Arial, Verdana, sans-serif;
  color: #000000;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-weight: normal;
  font-style: normal;
  font-size: 1.4rem;
  line-height: 1.8;
  font-weight: 400;
  letter-spacing: 0;
  height: 100%;
}
body.flat {
  background: #2980b9;
}
body.bubble {
  background: url("../img/background-bubble.jpg") center;
  background-size: cover;
}
body.bubble::after {
  content: '';
  position: absolute;
  z-index: 5;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(31, 34, 46, 0.8);
}

body, html {
  margin: 0;
  padding: 0;
  -webkit-tap-highlight-color: transparent;
  width: 100%;
}

body, input, select, textarea {
  -webkit-transition: all, 0.2s, ease-in-out;
  -moz-transition: all, 0.2s, ease-in-out;
  transition: all, 0.2s, ease-in-out;
}

a {
  -webkit-transition: all, 0.3s, ease-in-out;
  -moz-transition: all, 0.3s, ease-in-out;
  transition: all, 0.3s, ease-in-out;
  cursor: pointer;
  text-decoration: none;
  color: #FFFFFF;
  font-family: Montserrat, "Helvetica Neue", "Lucida Grande", Arial, Verdana, sans-serif;
}
a:hover {
  color: #00af94;
  text-decoration: none !important;
  outline: none !important;
}
a:active, a:focus {
  outline: none !important;
  text-decoration: none !important;
  color: #FFFFFF;
}

button {
  -webkit-transition: all, 0.2s, ease-in-out;
  -moz-transition: all, 0.2s, ease-in-out;
  transition: all, 0.2s, ease-in-out;
  cursor: pointer;
}
button:hover, button:active, button:focus {
  outline: none !important;
  text-decoration: none !important;
  color: #2B2D35;
}

strong, b {
  font-weight: 700;
}

em, i {
  font-style: italic;
}

p {
  font-family: "Open Sans", "Helvetica Neue", "Lucida Grande", Arial, Verdana, sans-serif;
  margin: 0;
  font-size: 1.5rem;
  line-height: 1.8;
  color: #d2d6e4;
  font-weight: 400;
  text-align: center;
}
p.subtitle {
  margin-bottom: 3rem;
}

h1, h2, h3, h4, h5, h6 {
  color: #FFFFFF;
  font-family: Montserrat, "Helvetica Neue", "Lucida Grande", Arial, Verdana, sans-serif;
  font-weight: 400;
  text-transform: uppercase;
  line-height: 1;
  margin: 0 0 1.5rem 0;
  text-align: center;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: inherit;
  text-decoration: none;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
  color: inherit;
}

h1 {
  font-size: 3rem;
}

h2 {
  font-size: 2rem;
}

h3 {
  font-size: 1.8rem;
}

h4 {
  font-size: 1.3rem;
}

h5 {
  font-size: 1rem;
}

h6 {
  font-size: 1rem;
}

sub {
  font-size: 0.8em;
  position: relative;
  top: 0.5em;
}

sup {
  font-size: 0.8em;
  position: relative;
  top: -0.5em;
}

.clear {
  clear: both;
}

.display-none {
  display: none !important;
}

.align-left {
  text-align: left;
}

.align-center {
  text-align: center;
}

.align-right {
  text-align: right;
}

.index-999 {
  z-index: -999 !important;
}

.row-no-margin {
  margin: 0;
}

.no-padding {
  padding: 0;
}

/* ------------------------------------- */
/* 2. Specific design .................. */
/* ------------------------------------- */
.logo-link {
  position: absolute;
  z-index: 20;
  display: block;
  top: 3rem;
  left: 3rem;
  width: 5rem;
}
.logo-link .logo {
  height: auto;
}

.content {
  height: 100vh;
  overflow: hidden;
  z-index: 10;
  position: relative;
  -webkit-box-align: center;
  -moz-box-align: center;
  box-align: center;
  -webkit-align-items: center;
  -moz-align-items: center;
  -ms-align-items: center;
  -o-align-items: center;
  align-items: center;
  -ms-flex-align: center;
  display: -webkit-box;
  display: -moz-box;
  display: box;
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -moz-box-pack: center;
  box-pack: center;
  -webkit-justify-content: center;
  -moz-justify-content: center;
  -ms-justify-content: center;
  -o-justify-content: center;
  justify-content: center;
  -ms-flex-pack: center;
}
.content .content-box {
  width: auto;
  position: relative;
}
.content .content-box .big-content {
  position: relative;
  width: 22rem;
  min-height: 22rem;
  margin: 0 auto 3rem;
}
.content .content-box .big-content .list-square {
  float: left;
}
.content .content-box .big-content .list-line {
  float: left;
  margin-left: 2rem;
}
.content .content-box .big-content span.square {
  display: block;
  background: transparent;
  width: 5rem;
  height: 5rem;
  -webkit-border-radius: 0.5rem;
  -moz-border-radius: 0.5rem;
  -ms-border-radius: 0.5rem;
  border-radius: 0.5rem;
  border: 1rem solid #FFFFFF;
  margin-bottom: 1.5rem;
}
.content .content-box .big-content span.line {
  display: block;
  background: #FFFFFF;
  width: 15rem;
  height: 1rem;
  -webkit-border-radius: 0.5rem;
  -moz-border-radius: 0.5rem;
  -ms-border-radius: 0.5rem;
  border-radius: 0.5rem;
  margin-bottom: 2.3rem;
}
.content .content-box .big-content span.line:nth-child(2) {
  width: 10rem;
}
.content .content-box .big-content span.line:nth-child(4) {
  width: 10rem;
}
.content .content-box .big-content span.line:nth-child(6) {
  width: 10rem;
}
.content .content-box .big-content .fa-search {
  position: absolute;
  top: 10rem;
  left: 15rem;
  font-size: 10rem;
  color: #00c8aa;
  -webkit-animation: corner 5s infinite;
  -moz-animation: corner 5s infinite;
  animation: corner 5s infinite;
}
.content .content-box .big-content .fa-search.color {
  color: #36c7c7;
}

@-webkit-keyframes corner {
  0% {
    -webkit-transform: translate(-2rem, 0);
    -webkit-animation-timing-function: 0, 0.02, 0, 1.01;
  }
  20% {
    -webkit-transform: translate(-15rem, 2rem);
  }
  40% {
    -webkit-transform: translate(-7rem, -7rem);
    animation-timing-function: cubic-bezier(0, 0.02, 0, 1.01);
  }
  60% {
    -webkit-transform: translate(-15rem, -10rem);
  }
  80% {
    -webkit-transform: translate(2rem, -12rem);
  }
  100% {
    -webkit-transform: translate(-2rem, 0);
  }
}
@-moz-keyframes corner {
  0% {
    -moz-transform: translate(-2rem, 0);
    -moz-animation-timing-function: 0, 0.02, 0, 1.01;
  }
  20% {
    -moz-transform: translate(-15rem, 2rem);
  }
  40% {
    -moz-transform: translate(-7rem, -7rem);
    animation-timing-function: cubic-bezier(0, 0.02, 0, 1.01);
  }
  60% {
    -moz-transform: translate(-15rem, -10rem);
  }
  80% {
    -moz-transform: translate(2rem, -12rem);
  }
  100% {
    -moz-transform: translate(-2rem, 0);
  }
}
@keyframes corner {
  0% {
    -webkit-transform: translate(-2rem, 0);
    -moz-transform: translate(-2rem, 0);
    -ms-transform: translate(-2rem, 0);
    -o-transform: translate(-2rem, 0);
    transform: translate(-2rem, 0);
    -webkit-animation-timing-function: 0, 0.02, 0, 1.01;
    -moz-animation-timing-function: 0, 0.02, 0, 1.01;
    animation-timing-function: 0, 0.02, 0, 1.01;
  }
  20% {
    -webkit-transform: translate(-15rem, 2rem);
    -moz-transform: translate(-15rem, 2rem);
    -ms-transform: translate(-15rem, 2rem);
    -o-transform: translate(-15rem, 2rem);
    transform: translate(-15rem, 2rem);
  }
  40% {
    -webkit-transform: translate(-7rem, -7rem);
    -moz-transform: translate(-7rem, -7rem);
    -ms-transform: translate(-7rem, -7rem);
    -o-transform: translate(-7rem, -7rem);
    transform: translate(-7rem, -7rem);
    animation-timing-function: cubic-bezier(0, 0.02, 0, 1.01);
  }
  60% {
    -webkit-transform: translate(-15rem, -10rem);
    -moz-transform: translate(-15rem, -10rem);
    -ms-transform: translate(-15rem, -10rem);
    -o-transform: translate(-15rem, -10rem);
    transform: translate(-15rem, -10rem);
  }
  80% {
    -webkit-transform: translate(2rem, -12rem);
    -moz-transform: translate(2rem, -12rem);
    -ms-transform: translate(2rem, -12rem);
    -o-transform: translate(2rem, -12rem);
    transform: translate(2rem, -12rem);
  }
  100% {
    -webkit-transform: translate(-2rem, 0);
    -moz-transform: translate(-2rem, 0);
    -ms-transform: translate(-2rem, 0);
    -o-transform: translate(-2rem, 0);
    transform: translate(-2rem, 0);
  }
}
footer {
  color: #FFFFFF;
  text-align: center;
  position: absolute;
  z-index: 20;
  padding: 1rem 0;
  bottom: 0;
  left: 0;
  width: 100%;
}
footer ul li {
  position: relative;
  display: inline-block;
  padding: 0;
}
footer ul li::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 0.2rem;
  height: 100%;
  -webkit-border-radius: 1rem;
  -moz-border-radius: 1rem;
  -ms-border-radius: 1rem;
  border-radius: 1rem;
  background: #735dd1;
}
footer ul li:last-child::after {
  display: none;
}
footer ul li a {
  text-transform: uppercase;
  display: block;
  width: 100%;
  height: 100%;
  padding: 0 2rem 0 1.4rem;
}
footer ul li a:hover {
  color: #6249cc;
}
footer ul li a:hover::after {
  opacity: 1;
  -webkit-transform: translateY(0) translateX(-60%);
  -moz-transform: translateY(0) translateX(-60%);
  -ms-transform: translateY(0) translateX(-60%);
  -o-transform: translateY(0) translateX(-60%);
  transform: translateY(0) translateX(-60%);
}
footer ul li a::after {
  position: absolute;
  top: 100%;
  left: 50%;
  width: 40%;
  height: 0.4rem;
  background: rgba(98, 73, 204, 0.4);
  content: '';
  opacity: 0;
  -webkit-border-radius: 1rem;
  -moz-border-radius: 1rem;
  -ms-border-radius: 1rem;
  border-radius: 1rem;
  -webkit-transform: translateY(1rem) translateX(-60%);
  -moz-transform: translateY(1rem) translateX(-60%);
  -ms-transform: translateY(1rem) translateX(-60%);
  -o-transform: translateY(1rem) translateX(-60%);
  transform: translateY(1rem) translateX(-60%);
  -webkit-transition: all, 0.3s, ease-in-out;
  -moz-transition: all, 0.3s, ease-in-out;
  transition: all, 0.3s, ease-in-out;
}
footer.light ul li::after {
  width: 0.1rem;
  background: rgba(117, 122, 134, 0.2);
}
footer.light ul li a {
  color: rgba(255, 255, 255, 0.7);
}
footer.light ul li a:hover {
  color: #FFFFFF;
}
footer.light ul li a::after {
  background: rgba(255, 255, 255, 0.3);
}

/* ------------------------------------- */
/* 3. Settings for variants ............ */
/* ------------------------------------- */
/* ------------------------------------- */
/* YouTube variant ..................... */
/* ------------------------------------- */
.mbYTP_wrapper {
  width: 100vw !important;
  min-width: 0 !important;
  left: 0 !important;
}
.mbYTP_wrapper::after {
  content: '';
  position: absolute;
  z-index: 10;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(45, 49, 56, 0.4);
}

/* ------------------------------------- */
/* FLAT variant ........................ */
/* ------------------------------------- */
#particles-js {
  position: fixed;
  top: 25vh;
  left: 25vw;
  width: 50vw;
  height: 50vh;
  z-index: -10;
}

/* ------------------------------------- */
/* Image variant ....................... */
/* ------------------------------------- */
.image {
  background: url("../img/image.jpg") center;
  background-size: cover;
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 5;
  -webkit-animation: kenburns 30s infinite;
  -moz-animation: kenburns 30s infinite;
  animation: kenburns 30s infinite;
}
.image::after {
  content: '';
  position: absolute;
  z-index: -5;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(45, 49, 56, 0.4);
}

@-webkit-keyframes kenburns {
  0% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.2);
  }
  100% {
    -webkit-transform: scale(1);
  }
}
@-moz-keyframes kenburns {
  0% {
    -moz-transform: scale(1);
  }
  50% {
    -moz-transform: scale(1.2);
  }
  100% {
    -moz-transform: scale(1);
  }
}
@keyframes kenburns {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
  }
  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
}
/* ------------------------------------- */
/* Slideshow variant ................... */
/* ------------------------------------- */
.vegas-overlay {
  opacity: 1;
  background: rgba(45, 49, 56, 0.4);
}

.vegas-timer-progress {
  background: #6C7A89;
}

/* ------------------------------------- */
/* Bubble variant ...................... */
/* ------------------------------------- */
#canvasbg, #canvas {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  background: transparent;
}

/* ------------------------------------- */
/* Mozaïc variant ...................... */
/* ------------------------------------- */
#dotty {
  position: fixed;
  top: 0;
  left: 0;
}

/* ------------------------------------- */
/* 4. Media Queries .................... */
/* ------------------------------------- */
/* Notebook devices @media only screen and (max-width: 1200px) */
/* Medium Devices, Desktops @media only screen and (max-width: 992px) */
/* Small Devices, Tablets @media only screen and (max-width: 768px) */
/* Extra Small Devices, Phones @media only screen and (max-width: 480px) */
@media only screen and (max-width: 480px) {
  .logo-link {
    position: relative;
    margin: 3rem auto 0;
    width: 5rem;
    display: block;
    top: auto;
    left: auto;
  }
  .logo-link .logo {
    width: 100%;
    max-width: none;
  }

  .content {
    height: auto;
    display: block;
    padding: 3rem 0 5rem;
  }
  .content .content-box {
    padding: 0 1rem;
  }
  .content .content-box .big-content {
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -ms-transform: scale(0.8);
    -o-transform: scale(0.8);
    transform: scale(0.8);
    margin: 0 auto;
  }

  h1 {
    font-size: 2rem;
    line-height: 1.5;
  }

  footer {
    position: relative;
    padding-bottom: 5rem;
  }
  footer ul li {
    width: 100%;
    margin-bottom: 1rem;
  }
  footer ul li::after {
    display: none;
  }
  footer ul li a {
    padding: 0;
  }
  footer ul li a::after {
    display: none;
  }

  #particles-js {
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
  }
}
/* Only for tablet in landscape mode @media only screen and (max-device-width: 1024px) and (orientation: landscape) */
/* Only for phone in landscape mode @media screen and (max-device-width: 667px) and (orientation: landscape) */
@media screen and (max-device-width: 667px) and (orientation: landscape) {
  .content {
    height: auto;
    display: block;
    padding: 5rem 0 5rem;
  }
  .content .content-box {
    padding: 0 1rem;
  }
  .content .content-box .big-content {
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -ms-transform: scale(0.8);
    -o-transform: scale(0.8);
    transform: scale(0.8);
    margin: 0 auto;
  }

  footer {
    position: relative;
    padding-bottom: 5rem;
  }
  footer ul li {
    width: 100%;
    margin-bottom: 1rem;
  }
  footer ul li::after {
    display: none;
  }
  footer ul li a {
    padding: 0;
  }
  footer ul li a::after {
    display: none;
  }

  #particles-js {
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
  }
}
    </style>
        
    </head>
    <body>
                  
                @yield('message')
          
                <script  src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script  src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>
