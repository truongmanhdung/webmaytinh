<?php header("Content-type: text/css; charset: UTF-8"); ?>
* {
margin: 0;
padding: 0;
list-style: none;
font-family: inherit;
/* font-family: 'Roboto Slab', serif; */
scroll-behavior: smooth;
box-sizing: border-box;
}
.info {
--borderWidth: 3px;
position: relative;
border-radius: var(--borderWidth);
}
#inpSearch:focus{
border-bottom-left-radius:unset;
border-bottom-right-radius:unset;
}
.info:after {
content: '';
position: absolute;
top: calc(-1 * var(--borderWidth));
left: calc(-1 * var(--borderWidth));
height: calc(100% + var(--borderWidth) * 2);
width: calc(100% + var(--borderWidth) * 2);
background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82);
border-radius: calc(2 * var(--borderWidth));
z-index: -1;
animation: animatedgradient 3s ease alternate infinite;
background-size: 300% 300%;
}

@keyframes animatedgradient {
0% {
background-position: 0% 50%;
}
50% {
background-position: 100% 50%;
}
100% {
background-position: 0% 50%;
}
}
.ul:after {
content: ".";
display: block;
clear: both;
visibility: hidden;
line-height: 0;
height: 0;
}

.in-top .info {
transform-origin: 50% 0%;
animation: in-top 300ms ease 0ms 1 forwards;
}

.in-right .info {
transform-origin: 100% 0%;
animation: in-right 300ms ease 0ms 1 forwards;
}

.in-bottom .info {
transform-origin: 50% 100%;
animation: in-bottom 300ms ease 0ms 1 forwards;
}

.in-left .info {
transform-origin: 0% 0%;
animation: in-left 300ms ease 0ms 1 forwards;
}

.out-top .info {
transform-origin: 50% 0%;
animation: out-top 300ms ease 0ms 1 forwards;
}

.out-right .info {
transform-origin: 100% 50%;
animation: out-right 300ms ease 0ms 1 forwards;
}

.out-bottom .info {
transform-origin: 50% 100%;
animation: out-bottom 300ms ease 0ms 1 forwards;
}

.out-left .info {
transform-origin: 0% 0%;
animation: out-left 300ms ease 0ms 1 forwards;
}

@keyframes in-top {
from {
transform: rotate3d(-1, 0, 0, 90deg);
}
to {
transform: rotate3d(0, 0, 0, 0deg);
}
}

@keyframes in-right {
from {
transform: rotate3d(0, -1, 0, 90deg);
}
to {
transform: rotate3d(0, 0, 0, 0deg);
}
}

@keyframes in-bottom {
from {
transform: rotate3d(1, 0, 0, 90deg);
}
to {
transform: rotate3d(0, 0, 0, 0deg);
}
}

@keyframes in-left {
from {
transform: rotate3d(0, 1, 0, 90deg);
}
to {
transform: rotate3d(0, 0, 0, 0deg);
}
}

@keyframes out-top {
from {
transform: rotate3d(0, 0, 0, 0deg);
}
to {
transform: rotate3d(-1, 0, 0, 102deg);
}
}

@keyframes out-right {
from {
transform: rotate3d(0, 0, 0, 0deg);
}
to {
transform: rotate3d(0, -1, 0, 102deg);
}
}

@keyframes out-bottom {
from {
transform: rotate3d(0, 0, 0, 0deg);
}
to {
transform: rotate3d(1, 0, 0, 101deg);
}
}

@keyframes out-left {
from {
transform: rotate3d(0, 0, 0, 0deg);
}
to {
transform: rotate3d(0, 1, 0, 102deg);
}
}
body::-webkit-scrollbar {
display: none;
}

a:hover {
text-decoration: unset!important
}

.pl-6 {
padding-left: 6px;
}

#blah {
cursor: pointer;
}

.carousel-control-next,
.carousel-control-prev {
width: 6%!important;
}

textarea {
width: 100%;
height: 90px;
}

<?php
include_once 'admin/connect.php';
foreach (selectAll("SELECT * FROM info WHERE id = 1") as $row) {
    $color = $row['color'];
}
?>
:root {
/* --background: #fb5530; */
--color: <?= $color ?>;
}
header {
background-color: var(--color);
}

.slider {
width: 1176px;
margin: 0 auto;
}

.container-fluid {
margin: 0 auto;
padding: 0;
list-style: none;
max-width: 100%;
}


/* Hover menu */

.fs-13 {
font-size: 13px;
}

.mr-5 {
margin-right: 5px !important;
}

.px-10 {
padding: 0 10px !important;
}

.gray {
color: #6a757f !important;
}

.w-1200 {
width: 1200px;
margin: auto !important;
max-width: 100%;
}

.contact div li {
margin-top: 10px;
}

.search {
position: relative;
width: 840px;
height: 40px;
}

.search input[type="search"] {
width: 840px;
height: 40px;
border-radius: 5px;
outline: none;
padding-left: 10px;
border: none;
background-color: #fff;
}

.search button {
position: absolute;
right: 5px;
top: 3px;
width: 60px;
height: 34px;
}

nav {
width: 1200px;
margin: auto;
}

.preview-images.me-3 label {
cursor: pointer;
}

.cart {
position: relative;
}
.no-cart{
    display: none;
    position: absolute;
    right: -8px;
    top: 45px;
}

.no-cart {
z-index: 1;
animation: zoom ease-in 0.25s;
transform-origin: top right;
width: 300px;
}



.no-cart::after {
content: "";
position: absolute;
right: 0px;
top: -40px;
border-width: 20px;
border-style: solid;
border-color: transparent transparent white transparent;
z-index: 20;
}

.image123 img{
    width: 50px;
    height: 50px;
    margin-right: 10px;
}
.cart-item{
    background-color: white;
}


@keyframes zoom {
from {
opacity: 0;
transform: scale(0);
}
to {
opacity: 1;
transform: scale(1)
}
}

.cart:hover .no-cart {
display: block;
cursor: pointer;
}

.pr-15 {
padding-right: 15px;
}

.px-30 {
padding: 0 30px;
}

a.text-secondary:hover {
color: var(--blue)!important;
text-decoration: none;
}

.nopadding {
padding: 0 !important;
margin: 0 !important;
}

.w-btn-db {
width: 190px;
border-radius: unset;
}

.product-filter {
width: 1200px !important;
margin: 20px auto;
}

.product-filter h3 {
border-bottom: 3px solid var(--color);
font-weight: bold;
color: var(--color);
}

.slsp i {
padding: 5px;
border: 1px solid var(--color);
}


/* product */

.list-product {
width: 1200px;
margin: auto;
text-align: center;
max-width: 100%;
}

.box.product-item {
overflow: hidden;
}

.box.product-item div {
width: 160px;
height: 160px;
display: flex;
align-items: center;
margin: auto;
}

.box.product-item div img {
width: 160px;
/* height: 160px; */
}

.hover-product:hover {
transform: scale(1.1);
transition: transform linear 0.6s;
}

.btn-ellipse:hover {
border-color: #48afcb;
background-color: #48afcb !important;
transition-delay: 0.3s;
}

.btn-ellipse:hover::before {
transform: translate(300%, -50%)!important;
transition: 0.5s;
}

.btn-ellipse:hover::after {
transform: translate(-300%, -50%)!important;
}

.btn-ellipse:before {
left: -20px;
transform: translate(-50%, -50%);
position: absolute;
top: 50%;
content: '';
width: 20px;
height: 20px;
background: #48afcb;
border-radius: 50%;
z-index: -1;
transition: 0.5s;
}

.btn-ellipse:after {
position: absolute;
transform: translate(50%, -50%);
top: 50%;
content: '';
width: 20px;
height: 20px;
background: #48afcb;
border-radius: 50%;
z-index: -1;
transition: 0.5s;
right: -20px;
}

.btn-ellipse {
position: relative;
background-color: #f2f2f2 !important;
z-index: 1;
overflow: hidden;
transition: 0.2s;
transition-delay: 0.1s;
}

.btn-ellipse {
display: inline-block;
padding: 12px 22px;
margin-bottom: 0;
font-size: 12px;
line-height: 1.4;
text-align: center;
color: #333;
border: 1px solid transparent;
border-radius: 3px;
}
.highlight {
background-color: #EEF43B!important;
}
.name-product {
margin: auto;
width: 126px;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
font-size: 13px;
line-height: 24px;
text-transform:uppercase;
}
.pl-2.m-0{
text-transform:uppercase!important;

}
.price {
color: red;
font-weight: bold;
line-height: 20px;
}

.buy {
margin-top: -5px;
}


/* end product */


/* Ribbon */

.box {
position: relative;
/* max-width: 600px; */
width: 180px !important;
height: 270px !important;
background: #fff;
box-shadow: 0 0 15px rgba(0, 0, 0, .1);
margin-bottom: 20px;
}


/* common */

.ribbon {
width: 100px;
height: 100px;
overflow: hidden;
position: absolute;
}

.ribbon::before,
.ribbon::after {
position: absolute;
z-index: -1;
content: '';
display: block;
border: 3px solid #1eb5ff;
}

.ribbon span {
position: absolute;
display: block;
width: 165px;
padding: 5px 0;
background-color: #1eb5ff;
box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
}

.wdp-ribbon {
display: inline-block;
padding: 2px 15px;
position: absolute;
right: 0px;
top: 20px;
line-height: 24px;
height: 24px;
text-align: center;
white-space: nowrap;
vertical-align: baseline;
border-radius: .25em;
border-radius: 0;
text-shadow: none;
font-weight: normal;
background-color: #1eb5ff !important;
}

.wdp-ribbon-six {
background: none !important;
position: relative;
box-sizing: border-box;
position: absolute;
width: 65px;
height: 65px;
top: 0px;
right: 0px;
padding: 0px;
overflow: hidden;
}

.wdp-ribbon-inner-wrap {
-ms-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
-webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
}

.wdp-ribbon-border {
width: 0;
height: 0;
border-right: 65px solid #fc2b2b;
border-bottom: 65px solid transparent;
z-index: 12;
position: relative;
top: -20px;
}

.wdp-ribbon-text {
color: white;
font-size: 13px;
font-weight: bold;
line-height: 13px;
position: absolute;
z-index: 14;
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
top: 15px;
left: -5px;
width: 91px;
text-align: center;
}


/* End Ribbon */

.text-left {
text-align: left;
}

.next-to-page {
text-align: center;
margin: 10px 0;
}

.next-to-page a {
border: 2px solid var(--color);
font-weight: bold;
line-height: 28px;
padding: 5px 9px;
color: var(--color);
background-color: #fff;
height: 34px;
width: 33px;
}

.next-to-page a:first-child {
color: rgb(255, 255, 255);
background-color: var(--color);
}

.next-to-page a:hover {
text-decoration: unset;
}

.back-to-top a {
border: 2px solid #fff;
font-weight: bold;
line-height: 28px;
padding: 5px 9px;
color: #fff;
background-color: var(--color);
height: 34px;
width: 33px;
}

.back-to-top {
transform: rotate(-90deg);
position: fixed;
right: 33px;
bottom: 10px;
/* display: none; */
}

footer {
width: 1200px;
margin: auto;
}

#footer div {
flex: 1;
}

#footer div h4 {
position: relative;
}

#footer div h4::after {
content: '';
position: absolute;
bottom: -20px;
left: 0;
width: 100px;
border-bottom: 2px solid var(--color);
animation: pulseBorder 3s infinite ease-in;
}

@keyframes pulseBorder {
0% {
width: 0px;
}
50% {
width: 240px;
}
100% {
width: 0px;
}
}

#footer div:nth-child(1) {
margin-right: 20px;
}

#footer div:nth-child(2) {
margin-right: 20px;
}

#footer div:nth-child(3) {
margin-right: 20px;
}

.mb-10 {
margin-bottom: 10px !important;
}

.mb-30 {
margin-bottom: 30px;
}

.mb-40 {
margin-bottom: 40px;
}

#footer li {
font-size: 15px;
font-weight: bold;
}

#footer p {
font-size: 15px;
font-weight: bold;
}

#footer div:last-child div {
width: 260px;
}

#footer div:last-child input {
width: 270px;
padding: 10px;
margin: 10px 0;
outline: none;
}

#footer div:last-child input:last-child {
font-weight: 900;
border: 2px solid #fff;
color: #fff;
background-color: var(--color);
}

#footer {
margin-bottom: 30px;
}

#copyright {
padding-top: 30px;
border-top: 2px solid #fff;
}

#copyright li {
padding: 0 20px;
}

.shop {
font-family: "Barlow", sans-serif;
position: relative;
display: inline-block;
font-size: 2em;
font-weight: 800;
color: royalblue;
overflow: hidden;
background: linear-gradient( to right, rgb(62, 241, 8), rgb(62, 241, 8) 50%, black 30%);
background-clip: text;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-size: 200% 100%;
background-position: 100%;
transition: background-position 275ms ease;
text-decoration: none;
animation: shop infinite 3s;
}

@keyframes shop {
0% {
background-position: 100% 0;
}
50% {
background-position: 0 100%;
}
}

#phone {
position: fixed;
width: 60px;
height: 60px;
background-color: rgb(187, 177, 177);
left: 40px;
bottom: 40px;
border-radius: 50%;
animation: background infinite 1s ease-out;
z-index: 2;
}

.border-phone {
position: fixed;
width: 60px;
height: 60px;
left: 40px;
bottom: 40px;
border-radius: 50%;
border: 3px solid rgba(243, 12, 4, 0.3);
animation: border-zoom ease-out 1s infinite;
z-index: 5;
}

@keyframes border-zoom {
0% {
transform: scale(1);
}
50% {
transform: scale(1.3);
}
100% {
transform: scale(1.9);
}
}

@keyframes background {
0% {
transform: scale(1)
}
50% {
transform: scale(1.2)
}
100% {
transform: scale(1.4)
}
}

.phone {
position: fixed;
width: 60px;
height: 60px;
background-color: rgb(117, 206, 16);
left: 40px;
bottom: 40px;
border-radius: 50%;
z-index: 3;
}

.telephone i {
position: fixed;
left: 60px;
bottom: 60px;
color: white;
font-size: 20px;
animation: rotate infinite 1s linear;
z-index: 4;
}

@keyframes rotate {
0% {
transform: rotateZ(20deg)
}
50% {
transform: rotateZ(50deg)
}
}

#wave {
position: relative;
bottom: 11px;
zoom: 2;
}

#wave span {
width: 5px;
height: 5px;
bottom: 0px;
position: absolute;
background: #3498db;
animation: wave 0.5s infinite ease;
}

#wave span:first-child {
left: 0px;
animation-delay: .3s;
}

#wave span:nth-child(2) {
left: 7px;
animation-delay: .4s;
}

#wave span:nth-child(3) {
left: 14px;
animation-delay: .6s;
}

#wave span:nth-child(4) {
left: 21px;
animation-delay: .8s;
}

#wave span:nth-child(5) {
left: 28px;
animation-delay: 1s;
}

@keyframes wave {
0% {
height: 5px;
background: var(--color);
}
30% {
height: 15px;
background: var(--color);
}
60% {
height: 20px;
background: var(--color);
}
80% {
height: 15px;
background: var(--color);
}
100% {
height: 5px;
background: var(--color);
}
}
.color{
background-color: var(--color)!important;
}
#color{
color:var(--color)!important;
}
.border-color{
border-color:var(--color)!important;
}
.hover-secondary:hover{
background:#d6d3d3;
}
mark{
background: orange;
color: black;
}
.before:before{
content:'';
position:absolute;
left:20px;
bottom:-10px;
width:200px;
border-bottom:1px solid #e4e2e2;
}