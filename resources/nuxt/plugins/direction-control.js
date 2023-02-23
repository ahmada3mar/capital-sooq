export default ({ app }, inject) => {
    const dir = () =>{
       return app.i18n.locales.find((x) => x.code === app.i18n.locale)?.dir;
    }
    inject('dir', dir);
    };
