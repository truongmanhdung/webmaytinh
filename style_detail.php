<?php header("Content-type: text/css; charset: UTF-8"); ?>
.title {
    margin-bottom: 10px;
}
.title button {
    width: 277px;
}

.select-none {
    user-select: none!important;
}

.fs-14 {
    font-size: 14px;
}

.ml-10 {
    margin-left: 3px;
}

.fs-14.policy {
    padding-bottom: 10px;
}

.policy:before {
    content: "●";
    background: var(--color);
    color: #ffffff;
    display: inline-block;
    border-radius: 3px;
    margin: 0 10px;
    padding: 2px 7px;
}

.text-light.ml-10 li.fs-14 {
    color: var(--color);
}

.name.text-center a:first-child {
    color: var(--color);
}

.fs-14.policy2 {
    padding-bottom: 10px;
}

body {
    counter-reset: id2;
    counter-reset: id;
}

.policy2:before {
    content: "●";
    background: var(--color);
    color: #ffffff;
    display: inline-block;
    border-radius: 3px;
    margin: 0 10px;
    padding: 2px 7px;
}

.j {
    color: #83e207;
}

.img_fancybox {
    width: 25%;
}

.p-10 {
    padding: 10px;
}

.radius {
    border-radius: 3%;
}

.quantity input {
    /* position: absolute; */
    height: 38px;
    width: 50px;
    text-align: center;
    padding-left: 13px;
}

.quantity button {
    margin-top: -5px;
}

#content {
    float: left;
    position: absolute;
    background-color: #D4D3D0;
    height: 500px;
    width: 80%;
    white-space: pre-wrap;
}

p.test {
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    -webkit-hyphens: auto;
    hyphens: auto;
    word-wrap: break-word;
}

.comment {
    display: grid;
    grid-template-columns: 53px 696px;
    grid-gap: 20px;
}

.comment .name-user {
    font-weight: bold;
    margin-bottom: unset;
}

.comment .name-user span:first-child {
    padding-right: 5px;
    border-right: 1px solid rgb(180, 180, 180);
}

.comment .name-user span:last-child {
    padding-left: 5px;
    border-left: 1px solid rgb(180, 180, 180);
    color: gray;
    user-select: none;
}

.fa-pencil-alt {
    margin-left: 10px;
}

.form-label {
    user-select: none;
}