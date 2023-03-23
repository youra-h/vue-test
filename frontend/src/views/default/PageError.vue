<template lang="html">
    <div class="page_error">
        <div class="error_numeric ai-flex-center jc-flex-center">
            <span>{{getFirstNum}}</span>
            <span class="cssload-clock"></span>
            <span>{{getLastNum}}</span>
        </div>
        <div class="error_caption">
            <!-- {{$t(getNumError("PageError.caption"))}} -->
            Error
        </div>
        <div class="error_text">
            <!-- {{$t(getNumError("PageError.text"))}} -->
            Error
        </div>
        <div class="error_link">
            <router-link
                :to="{ name: 'main'}"
                :class="['cmp cmp-gray btn']"
                tag="button"
                >
                Error
                <!-- {{$t('caption.on-main')}} -->
            </router-link>
        </div>
    </div>
</template>

<script>
export default
{
    metaInfo() {
        return {
            title: 'PageError.caption.404',
        }
    },
    computed: {
        numError() {
            return this.$route.name;
        },
        getFirstNum() {
            return this.numError.substr(0,1);
        },
        getLastNum() {
            return this.numError.substr(2,1);
        }
    },
    methods: {
        getNumError(caption) {
            return caption + '.' + this.numError
        }
    }
}
</script>

<style lang="css" scoped>
/*PAGE ERROR*/

.page_error {
    font-family: var(--font-family-alt);
    padding: 0 12rem;
}

.page_error * {
    line-height: normal;
    text-align: center;
    color: var(--color-text-page-error);
    font-weight: 300;
}

.page_error .error_numeric {
    font-size: 5rem;
    display: flex;
}

.page_error .error_numeric span {
    font-weight: 500;
}

.page_error .error_caption {
    font-size: 3em;
    padding: 5px 0;
}

.page_error .error_text {
    font-size: 1.2em;
    padding: 5px 0;
}

.page_error .error_link {
    padding: 30px 10px;
}

.page_error .error_link button {
    font-weight: 400;
}

/*MEDIA*/

@media (min-width: 768px) and (max-width: 991px) {
    .page_error {
        padding: 0 8rem;
    }
}

@media (min-width: 551px) and (max-width: 991px) {
    .page_error {
        padding: 0 4rem;
    }
}

@media (max-width: 550px) {
    .page_error {
        padding: 0 2rem;
    }
}

/*CLOCK ANIMATION*/
.cssload-clock{
	border-radius: 58px;
	border: 3px solid var(--color-text-page-error);
	height: 55px;
	width: 55px;
	position: relative;
}
.cssload-clock:after{
	content: "";
	position: absolute;
	background-color: var(--color-text-page-error);
	top: 2px;
	left: 46%;
	height: 26px;
	width: 4px;
	border-radius: 5px;
	transform-origin: 50% 97%;
		-o-transform-origin: 50% 97%;
		-ms-transform-origin: 50% 97%;
		-webkit-transform-origin: 50% 97%;
		-moz-transform-origin: 50% 97%;
	animation: grdAiguille 3.2s linear infinite;
		-o-animation: grdAiguille 3.2s linear infinite;
		-ms-animation: grdAiguille 3.2s linear infinite;
		-webkit-animation: grdAiguille 3.2s linear infinite;
		-moz-animation: grdAiguille 3.2s linear infinite;
}



.cssload-clock:before{
	content: "";
	position: absolute;
	background-color: var(--color-text-page-error);
	top: 6px;
	left: 46%;
	height: 23px;
	width: 4px;
	border-radius: 5px;
	transform-origin: 50% 94%;
		-o-transform-origin: 50% 94%;
		-ms-transform-origin: 50% 94%;
		-webkit-transform-origin: 50% 94%;
		-moz-transform-origin: 50% 94%;
	animation: ptAiguille 19.2s linear infinite;
		-o-animation: ptAiguille 19.2s linear infinite;
		-ms-animation: ptAiguille 19.2s linear infinite;
		-webkit-animation: ptAiguille 19.2s linear infinite;
		-moz-animation: ptAiguille 19.2s linear infinite;
}



@keyframes grdAiguille{
		0%{transform:rotate(0deg);}
		100%{transform:rotate(360deg);}
}

@-o-keyframes grdAiguille{
		0%{-o-transform:rotate(0deg);}
		100%{-o-transform:rotate(360deg);}
}

@-ms-keyframes grdAiguille{
		0%{-ms-transform:rotate(0deg);}
		100%{-ms-transform:rotate(360deg);}
}

@-webkit-keyframes grdAiguille{
		0%{-webkit-transform:rotate(0deg);}
		100%{-webkit-transform:rotate(360deg);}
}

@-moz-keyframes grdAiguille{
		0%{-moz-transform:rotate(0deg);}
		100%{-moz-transform:rotate(360deg);}
}

@keyframes ptAiguille{
		0%{transform:rotate(0deg);}
		100%{transform:rotate(360deg);}
}

@-o-keyframes ptAiguille{
		0%{-o-transform:rotate(0deg);}
		100%{-o-transform:rotate(360deg);}
}

@-ms-keyframes ptAiguille{
		0%{-ms-transform:rotate(0deg);}
		100%{-ms-transform:rotate(360deg);}
}

@-webkit-keyframes ptAiguille{
		0%{-webkit-transform:rotate(0deg);}
		100%{-webkit-transform:rotate(360deg);}
}

@-moz-keyframes ptAiguille{
		0%{-moz-transform:rotate(0deg);}
		100%{-moz-transform:rotate(360deg);}
}
</style>
