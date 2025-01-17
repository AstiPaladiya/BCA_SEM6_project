// Translate Launguage

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    defaultLanguage : 'en',
    includedLanguages : 'en,gu,hi,kn,gom,ml,mr,mni-Mtei,pa,sa,sd,ta,te,',
    layout : google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay : false,
    multilanguagePage : true,
    }
    , 'google_translate_element');
}
