import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);

//Загрузка языка по умолчанию
import Locale from "@/i18n/Locale.js";

//Установка локализации по умолчанию
export default function makeI18n( locale )
{
    let arrayMessages = require(`@/i18n/messages/${locale}.json`)
    let messages = {}
    messages[locale] = arrayMessages

    var i18n = new VueI18n({
        locale: locale,
        fallbackLocale: locale,
        messages
    });

     //Инициализации асинхронной загрузки языковых настроек
    Locale.init(i18n);

    return i18n;
}
