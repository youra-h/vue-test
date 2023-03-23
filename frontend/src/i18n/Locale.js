export default class Locale
{
    static i18n;
    static lang;
    static vm;
    // список локализаций, которые пред-загружены
    static loadedLanguages;

    //Public
    static init(i18n)
    {
        this.loadedLanguages = [];
        this.i18n = i18n
        this.vm = i18n.vm;
        this.lang = i18n.locale
        this.loadedLanguages.push(this.lang)
        this.setCookie()
    };

    static setCookie()
    {
        this.vm.$cookie.set('locale', this.lang, {expires: 3600})
    };

    static setI18nLanguage()
    {
        this.i18n.locale = this.lang
        this.vm.$http.defaults.headers.common['Accept-Language'] = this.lang
        document.querySelector('html').setAttribute('lang', this.lang)
        this.vm.$Progress.finish()
        this.setCookie();
        return this.lang
    };

    static loadLanguageAsync()
    {
        //Запуск прогрессбара
        this.vm.$Progress.start()

        // Если локализация та же
        if (this.i18n.locale === this.lang)
        {
            return Promise.resolve(this.setI18nLanguage())
        }

        // Если локализация уже была загружена
        if (this.loadedLanguages.includes(this.lang))
        {
            return Promise.resolve(this.setI18nLanguage())
        }

        // Если локализация ещё не была загружена
        return import(
            /* webpackChunkName: "lang-[request]" */
            `@/i18n/messages/${this.lang}.json`
        ).then(messages => {
            this.i18n.setLocaleMessage(this.lang, messages.default)
            this.loadedLanguages.push(this.lang)
            return this.setI18nLanguage()
        })
    };

    //Public
    static change(lang) {
        this.lang = lang.toLowerCase();
        return this.loadLanguageAsync();
    }
}
