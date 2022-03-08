<?php header("Content-type: text/css; charset: UTF-8"); ?>


:root {
    --white-color: rgb(255, 255, 255);
    --balck-color: rgb(0, 0, 0);
    --body-BG-color: rgb(225, 232, 255);
    --wrapper-shadow-color: rgba(255, 255, 255, 0.439);
    --aside-area-BG-color: rgb(82, 116, 255);
    --aside-area-width: 330px;
    --error-color: rgb(231, 76, 60);
    --success-color: rgb(46, 204, 113);
    --primary-light-gray: rgb(184, 180, 180);
    --primary-color: rgb(82, 116, 255);
    --light-blue-color: rgb(141 162 246);
    --input-border-color: rgb(152, 169, 192);
    --paragraph-color: rgb(231, 231, 231);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', Arial, sans-serif;
}

body {
    height: 100vh;
    background-color: var(--body-BG-color);
    display: flex;
    justify-content: center;
    align-items: center;
}


/* End Css Reset */


/* Wrapper Area */

.wrapper__area {
    position: relative;
    width: 800px;
    height: 650px;
    background-color: var(--white-color);
    box-shadow: 0 0 50px var(--wrapper-shadow-color);
    border: 5px solid var(--wrapper-shadow-color);
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    overflow: hidden;
    transform: scale(0.9);
}


/* Forms Area */

.forms__area {
    position: relative;
    width: calc(100% - var(--aside-area-width));
    height: 100%;
    background-color: transparent;
    margin-right: 10px;
}


/* Form */

.forms__area form {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    padding: 20px 20px 10px 20px;
    transition: 1.2s cubic-bezier(0.18, 0.02, 0.36, 0.96);
    opacity: 1;
}

form.sign-up__form {
    /* Hide The Sign Up */
    margin-top: -650px;
}


/* Form Title */

form .form__title {
    font-size: 45px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 40px;
}

.sign-up__form .form__title {
    /* Sign Up Form Title */
    margin-bottom: 25px;
}


/* Input Group */

form .input__group {
    position: relative;
    width: 100%;
    margin: 10px 0;
}


/* Field */

form .input__group .field {
    position: relative;
    width: 100%;
    height: auto;
    display: inline-block;
    transition: 0.3s ease-in-out;
    overflow: hidden;
}


/* Field After ( For Border Animation Focus ) */

form .input__group .field::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 2px;
    background-color: var(--primary-color);
    transform: translateX(-100%);
    transition: 0.3s ease-in-out;
}

form .input__group .field:focus::after,
form .input__group .field:focus-within::after {
    transform: translateX(0);
}


/* Text And Password Inputs */

form .input__group input[type="text"],
form .input__group input[type="password"] {
    position: relative;
    outline: none;
    width: 100%;
    border: none;
    padding: 15px 40px 15px 40px;
    background: transparent;
    border-bottom: 2px solid var(--input-border-color);
}


/* Form Error */

form .formError .field input {
    border-color: var(--error-color);
}


/* FormSuccess */

form .formSuccess .field input {
    border-color: var(--success-color);
}


/* For Input Autofill */

form .input__group input:-webkit-autofill,
form .input__group input:-webkit-autofill:hover,
form .input__group input:-webkit-autofill:focus,
form .input__group input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 30px white inset !important;
    box-shadow: 0 0 0 30px white inset !important;
    background: transparent;
}


/* Next Span */

form .input__group>span {
    position: absolute;
    font-size: 18px;
    color: var(--primary-light-gray);
    transition: 0.3s ease-in-out;
}

form .input__group input[type="text"]:focus~span,
form .input__group input[type="password"]:focus~span {
    color: var(--primary-color);
}


/* Input Icon */

form .input__group .input__icon {
    top: 13px;
    left: 13px;
    pointer-events: none;
}


/* Show Hide Icon */

form .input__group .showHide__Icon {
    top: 13px;
    right: 13px;
    width: 20px;
    height: 20px;
    cursor: pointer;
}

form .input__group .showHide__Icon:hover {
    color: var(--primary-color);
}


/* Error Message */

form .input__group .input__error_message {
    display: block;
    color: var(--error-color);
    margin: 0 10px;
    opacity: 0;
    pointer-events: none;
    transition: 0.3s ease-in-out;
    text-transform: capitalize;
}


/* Form Error class */

form .formError .input__error_message {
    opacity: 1;
}


/* Form Success class */

form .formSuccess .input__error_message {
    opacity: 0;
}


/* Form Actions */

form .form__actions {
    position: relative;
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}


/* EveryThing In The Form Action */

form .form__actions * {
    transition: 0.3s ease-in-out;
}


/* Next Label And Next Div */

form .form__actions>label:hover,
form .form__actions>div:hover {
    opacity: 0.7;
}


/* Remeber Me And Input */

.form__actions .remeber_me,
.form__actions .remeber_me input {
    position: relative;
    cursor: pointer;
    font-size: 15px;
    color: var(--primary-light-gray);
}


/* Input And Checkmark box */

.form__actions .remeber_me input,
.form__actions .remeber_me .checkmark {
    width: 20px;
    height: 20px;
    top: 5px;
}

.form__actions .remeber_me input {
    opacity: 0;
    z-index: 2;
}

.form__actions .remeber_me .checkmark {
    position: absolute;
    left: 0;
    border: 2px solid var(--primary-light-gray);
    border-radius: 3px;
    z-index: 1;
}


/* Create Check Mark */

.form__actions .remeber_me .checkmark::after {
    content: "";
    position: absolute;
    opacity: 0;
    left: 5px;
    top: 2px;
    width: 3px;
    height: 8px;
    border: solid var(--primary-color);
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg) scale(0);
    transform: rotate(45deg) scale(0);
    transition: 0.3s ease-in-out;
}


/* When Input Checkbox Is Checked */

.form__actions .remeber_me input:checked~.checkmark~span {
    color: var(--primary-color);
}

.form__actions .remeber_me input:checked~.checkmark {
    border-color: var(--primary-color);
}

.form__actions .remeber_me input:checked~.checkmark::after {
    opacity: 1;
    -webkit-transform: rotate(45deg) scale(1);
    transform: rotate(45deg) scale(1);
}


/* Forgot Password */

.form__actions .forgot_password {
    position: relative;
    top: 4px;
    cursor: pointer;
    font-size: 15px;
    color: var(--primary-color);
    transition: 0.3s ease-in-out;
    font-weight: 550;
}


/* Submit Button */

button.submit-button {
    position: relative;
    width: 65%;
    background-color: var(--primary-color);
    color: var(--white-color);
    cursor: pointer;
    padding: 16px 0;
    border: none;
    border-radius: 5px;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: 2px;
    margin: 50px auto 10px;
    display: block;
    outline: none;
    transition: 0.5s ease-in-out;
    overflow: hidden;
    text-transform: uppercase;
}

.sign-up__form button.submit-button {
    /* Sign Up Submit Button */
    margin-top: 25px;
}

button.submit-button:hover {
    opacity: 0.8;
}

button.submit-button:active {
    opacity: 1;
}


/* Alternate Login */

.alternate-login {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: space-around;
    margin-top: 40px;
}

.sign-up__form .alternate-login {
    /* Sign Up Alternate Login */
    margin-top: 25px;
}

.alternate-login .link {
    border: 2px solid var(--primary-light-gray);
    margin: 10px;
    padding: 7px 25px 5px;
    border-radius: 50px;
    cursor: pointer;
    transition: 0.4s ease-out;
    color: var(--primary-light-gray);
}

.alternate-login .link:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.alternate-login .link i {
    font-size: 18px;
    position: relative;
    top: 2px;
}


/* Forms Animation */


/* When Sign Up Mode Is Active\ Sign Up Form */

form.sign-up__form {
    opacity: 0;
}

.wrapper__area.sign-up__Mode-active form.sign-up__form {
    margin-top: 0;
    opacity: 1;
}


/* When Sign Up Mode Is Active\ Login Form */

.wrapper__area.sign-up__Mode-active form.login__form {
    margin-top: 650px;
    opacity: 0;
}


/* End Forms Animation */


/* Aside Area */

.aside__area {
    position: relative;
    width: var(--aside-area-width);
    height: 100%;
    background-color: var(--aside-area-BG-color);
    border-radius: 5px;
    opacity: 1;
}


/* Sides */

.aside__area>div {
    position: relative;
    width: 100%;
    height: 100%;
    padding: 10px;
    text-align: center;
    transition: 1.2s cubic-bezier(0.18, 0.02, 0.36, 0.96);
    margin-top: 30px;
}

.aside__area>div h4 {
    color: var(--white-color);
    letter-spacing: 5px;
    font-weight: 500;
    font-size: 35px;
    position: absolute;
    left: 24px;
}

.aside__area>div img {
    width: 100%;
    pointer-events: none;
}

.aside__area>div p {
    color: var(--paragraph-color);
    font-size: 14px;
    padding: 20px;
    margin-bottom: 20px;
}

.aside__area>div button {
    display: block;
    outline: none;
    background-color: transparent;
    width: 60%;
    margin: auto;
    border: 2px solid var(--white-color);
    color: var(--white-color);
    cursor: pointer;
    padding: 14px 0;
    border-radius: 2px;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 2px;
    transition: 0.5s ease-in-out;
}

.aside__area>div button:hover {
    border-color: var(--white-color);
    background-color: var(--white-color);
    color: vAR(--balck-color);
}

.aside__area>div button:active {
    opacity: 0.8;
}


/* Aside Animation */


/* When Sign Up Mode Is Active\ Sign Up Side */

.wrapper__area.sign-up__Mode-active .login__aside-info {
    /* Login Aside */
    margin-top: -650px;
    opacity: 0;
}


/* When Sign Up Mode Is Active\ Login Side */

.sign-up__aside-info {
    /* Sign Up Aside */
    opacity: 0;
}

.wrapper__area.sign-up__Mode-active .sign-up__aside-info {
    opacity: 1;
}


/* End Aside Animation */


/* End Wrapper Area */