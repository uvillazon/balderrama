package org.balderrama.client.util;

import com.google.gwt.i18n.client.DateTimeFormat;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONNumber;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.RootPanel;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.MessageBox;
import java.util.Date;
import org.balderrama.client.util.KMessageWait;

/**
 *
 * @author FOREGROUND
 */
public class Utils {

    private static String path = "/web/";
    private static KMessageWait kespera = new KMessageWait();
//    private static MessageBox Kmensaje =  new MessageBox();

    public Utils() {
    }

    public String Codificar() {
        return "";
    }

    public static String getStringOfJSONObject(JSONObject datO, String aguja) {
        String dev = "";
        try {
            JSONValue dat = datO.get(aguja);
            JSONString datS;
//        if ((pagoO = pagoV.isObject()) != null) {
            if ((datS = dat.isString()) != null) {
                if (datS != null) {
                    dev = datS.stringValue();
                } else {
                    Utils.setErrorPrincipal("El valor de " + aguja + " es nulo ", "error");
                }
            }
        } catch (Exception e) {
            Utils.setErrorPrincipal("No existe la variable: " + aguja, "error");
        }
        return dev;
    }

    public static Number getBigDecimalOfJSONObject(JSONObject datO, String aguja) {
        Number dev = 0;
        JSONValue dat = datO.get(aguja);
        JSONNumber datS = dat.isNumber();
        if (datS != null) {
            dev = datS.doubleValue();
        } else {
            JSONString datSS = dat.isString();
            if (datSS != null) {
                String tee = datSS.stringValue();
                Double dd = new Double(tee);
                dev = dd;
            }
        }
        return dev;
    }

    public static void setErrorPrincipal(String mensaje, String tipo) {
        RootPanel errorP;
        errorP = RootPanel.get("errores");
        errorP.setVisible(true);
        errorP.clear();
        Label e = new Label(mensaje);
//        com.google.gwt.user.client.Window.alert("dd" + errorP.getAbsoluteTop());
        if (tipo.equalsIgnoreCase("error")) {
//            Image load = new Image("img_loading", "img/cancel.gif");
            errorP.setStyleName("kmensajeError");
            errorP.add(e);

            kespera.khide();
            MessageBox.alert(mensaje);
            
//            com.google.gwt.user.client.Window.alert("dd" + errorP.getAbsoluteTop());

        } else if (tipo.equalsIgnoreCase("mensaje")) {
//            Image load = new Image("img_loading", "img/ok16.png");
            errorP.setStyleName("kmensajeMensaje");
            errorP.add(e);
//            errorP.add(load, errorP.getAbsoluteLeft(), errorP.getAbsoluteTop() + 4);
//            errorP.add(e, errorP.getAbsoluteLeft() + 20, errorP.getAbsoluteTop() + 5);
            kespera.khide();
        } else if (tipo.equalsIgnoreCase("cargar")) {
//            Image load = new Image("img_loading", "img/loading.gif");
            errorP.setStyleName("kmensaje");
            errorP.add(e);
//            errorP.add(load, errorP.getAbsoluteLeft(), errorP.getAbsoluteTop() + 4);
//            errorP.add(e, errorP.getAbsoluteLeft() + 20, errorP.getAbsoluteTop() + 5);
            kespera.setMensajeArriba(mensaje);
            kespera.setMensajeProgreso("Cargando ...");
            kespera.kshow();
        } else if (tipo.equalsIgnoreCase("guardar")) {
//            Image load = new Image("img_loading", "img/loading.gif");
            errorP.setStyleName("kmensajeGuardar");
            errorP.add(e);
//            errorP.add(load, errorP.getAbsoluteLeft(), errorP.getAbsoluteTop() + 4);
//            errorP.add(e, errorP.getAbsoluteLeft() + 20, errorP.getAbsoluteTop() + 5);
            kespera.setMensajeArriba(mensaje);
            kespera.setMensajeProgreso("Guardando ...");
            kespera.kshow();
        } else {
            errorP.clear();
        }

    // Create a new timer that calls Window.alert().
//        Timer t = new Timer() {
//
//            public void run() {
//                RootPanel.get("errores").clear();
//                RootPanel.get("errores").setVisible(false);
//            }
//        };
//        t.schedule(5000);
    }

    public static Object[][] getArrayOfJSONObject(JSONObject datO, String aguja, String[] campos) {
        Object[][] dev = null;
        JSONValue dat = datO.get(aguja);
        if (dat != null) {
            JSONArray jarray;

            if ((jarray = dat.isArray()) != null) {
                int j = 0;
                dev =
                        new Object[jarray.size()][2];
                for (int i = 0; i < jarray.size(); i++) {
                    JSONValue roV = jarray.get(i);
                    JSONObject roO;

                    if ((roO = roV.isObject()) != null) {
                        for (int zzz = 0; zzz < campos.length; zzz++) {
                            dev[j][zzz] = Utils.getStringOfJSONObject(roO, campos[zzz]);
                        }
                        j++;
                    }
                }
            } else {
                Utils.setErrorPrincipal("No existe el Array " + aguja, "error");
            }
        }
        return dev;
    }

    public static Object[][] getObjetsFiltrado(SimpleStore fuente, String filtron, String filtrov, int longcampos, boolean todos) {
        Object[][] devO;
        if (fuente != null) {
            Record[] fuen = fuente.getRecords();

            String[] tthis;
            int bandera = 0;
            for (int w = 0; w < fuen.length; w++) {
                if (fuen[w].getAsString(filtron).equalsIgnoreCase(filtrov)) {
                    bandera++;
                }
            }

            int z = 0;
            if (todos == true) {
                bandera = bandera + 1;
            }
            devO = new Object[bandera][longcampos];
            if (todos == true) {
                for (int j = 0; j < longcampos; j++) {
                    devO[0][j] = "Todos";
                }
                z = 1;
            }
            for (int i = 0; i < fuen.length; i++) {
                tthis = fuen[i].getFields();
                if (fuen[i].getAsString(filtron).equalsIgnoreCase(filtrov)) {
                    for (int jj = 0; jj < longcampos; jj++) {
                        devO[z][jj] = fuen[i].getAsString("" + tthis[jj]);
                    }
                    z++;
                }
                tthis = null;
            }
        } else {
            devO = null;
        }
        return devO;
    }

    public static Object[][] setTodosObjetsFiltrado(SimpleStore fuente, int longcampos, String cadena) {
        Object[][] devO;
        if (fuente != null) {
            Record[] fuen = fuente.getRecords();

            String[] tthis;
            int bandera = fuen.length;
            bandera = bandera + 1;
            int z = 1;
            devO = new Object[bandera][longcampos];
            for (int j = 0; j < longcampos; j++) {
                devO[0][j] = cadena;
            }
            for (int i = 0; i < fuen.length; i++) {
                tthis = fuen[i].getFields();
                for (int jj = 0; jj < longcampos; jj++) {
                    devO[z][jj] = fuen[i].getAsString("" + tthis[jj]);
                }
                z++;
                tthis = null;
            }
        } else {
            devO = null;
        }
        return devO;
    }

    public static Object[][] setTodosObjetsArray(Object[][] fuente, int longcampos, String cadena) {
        Object[][] devO;
        if (fuente != null) {

            int bandera = fuente.length;
            bandera = bandera + 1;
            int z = 1;
            devO = new Object[bandera][longcampos];
            for (int j = 0; j < longcampos; j++) {
                devO[0][j] = cadena;
            }
            for (int i = 0; i < fuente.length; i++) {
                for (int jj = 0; jj < longcampos; jj++) {
                    devO[z][jj] = fuente[i][jj];
                }
                z++;
            }
        } else {
            devO = new Object[1][longcampos];
            for (int j = 0; j < longcampos; j++) {
                devO[0][j] = cadena;
            }
        }
        return devO;
    }

    public static native String md5(String string) /*-{
    function RotateLeft(lValue, iShiftBits) {
    return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
    }
    function AddUnsigned(lX,lY) {
    var lX4,lY4,lX8,lY8,lResult;
    lX8 = (lX & 0x80000000);
    lY8 = (lY & 0x80000000);
    lX4 = (lX & 0x40000000);
    lY4 = (lY & 0x40000000);
    lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
    if (lX4 & lY4) {
    return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
    }
    if (lX4 | lY4) {
    if (lResult & 0x40000000) {
    return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
    } else {
    return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
    }
    } else {
    return (lResult ^ lX8 ^ lY8);
    }
    }
    function F(x,y,z) { return (x & y) | ((~x) & z); }
    function G(x,y,z) { return (x & z) | (y & (~z)); }
    function H(x,y,z) { return (x ^ y ^ z); }
    function I(x,y,z) { return (y ^ (x | (~z))); }
    function FF(a,b,c,d,x,s,ac) {
    a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
    return AddUnsigned(RotateLeft(a, s), b);
    };
    function GG(a,b,c,d,x,s,ac) {
    a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
    return AddUnsigned(RotateLeft(a, s), b);
    };
    function HH(a,b,c,d,x,s,ac) {
    a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
    return AddUnsigned(RotateLeft(a, s), b);
    };
    function II(a,b,c,d,x,s,ac) {
    a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
    return AddUnsigned(RotateLeft(a, s), b);
    };
    function ConvertToWordArray(string) {
    var lWordCount;
    var lMessageLength = string.length;
    var lNumberOfWords_temp1=lMessageLength + 8;
    var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1
    % 64))/64;
    var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
    var lWordArray=Array(lNumberOfWords-1);
    var lBytePosition = 0;
    var lByteCount = 0;
    while ( lByteCount < lMessageLength ) {
    lWordCount = (lByteCount-(lByteCount % 4))/4;
    lBytePosition = (lByteCount % 4)*8;
    lWordArray[lWordCount] = (lWordArray[lWordCount] |
    (string.charCodeAt(lByteCount)<<lBytePosition));
    lByteCount++;
    }
    lWordCount = (lByteCount-(lByteCount % 4))/4;
    lBytePosition = (lByteCount % 4)*8;
    lWordArray[lWordCount] = lWordArray[lWordCount] |
    (0x80<<lBytePosition);
    lWordArray[lNumberOfWords-2] = lMessageLength<<3;
    lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
    return lWordArray;
    };
    function WordToHex(lValue) {
    var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
    for (lCount = 0;lCount<=3;lCount++) {
    lByte = (lValue>>>(lCount*8)) & 255;
    WordToHexValue_temp = "0" + lByte.toString(16);
    WordToHexValue = WordToHexValue +
    WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
    }
    return WordToHexValue;
    };
    function Utf8Encode(string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";
    for (var n = 0; n < string.length; n++) {
    var c = string.charCodeAt(n);
    if (c < 128) {
    utftext += String.fromCharCode(c);
    }
    else if((c > 127) && (c < 2048)) {
    utftext += String.fromCharCode((c >> 6) | 192);
    utftext += String.fromCharCode((c & 63) | 128);
    }
    else {
    utftext += String.fromCharCode((c >> 12) | 224);
    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
    utftext += String.fromCharCode((c & 63) | 128);
    }
    }
    return utftext;
    };
    var x=Array();
    var k,AA,BB,CC,DD,a,b,c,d;
    var S11=7, S12=12, S13=17, S14=22;
    var S21=5, S22=9 , S23=14, S24=20;
    var S31=4, S32=11, S33=16, S34=23;
    var S41=6, S42=10, S43=15, S44=21;
    string = Utf8Encode(string);
    x = ConvertToWordArray(string);
    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
    for (k=0;k<x.length;k+=16) {
    AA=a; BB=b; CC=c; DD=d;
    a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
    d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
    c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
    b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
    a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
    d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
    c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
    b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
    a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
    d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
    c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
    b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
    a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
    d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
    c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
    b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
    a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
    d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
    c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
    b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
    a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
    d=GG(d,a,b,c,x[k+10],S22,0x2441453);
    c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
    b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
    a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
    d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
    c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
    b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
    a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
    d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
    c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
    b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
    a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
    d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
    c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
    b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
    a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
    d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
    c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
    b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
    a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
    d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
    c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
    b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
    a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
    d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
    c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
    b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
    a=II(a,b,c,d,x[k+0], S41,0xF4292244);
    d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
    c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
    b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
    a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
    d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
    c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
    b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
    a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
    d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
    c=II(c,d,a,b,x[k+6], S43,0xA3014314);
    b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
    a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
    d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
    c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
    b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
    a=AddUnsigned(a,AA);
    b=AddUnsigned(b,BB);
    c=AddUnsigned(c,CC);
    d=AddUnsigned(d,DD);
    }
    var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
    return temp.toLowerCase();
    }-*/;

    public static void seleccionarComboBox(String valor, boolean id) {
    }

    public static native void imprimirDivSinCabecera(String nombre)/*-{
    
    var ventimp = window.open('../', 'popimpr');
    ventimp.document.write(nombre);
    ventimp.document.close();
    // alert("Se va a imprirmir el reporte");
    ventimp.print();
    //ventimp.stop();                                                             *
    ventimp.close();
    //                                                                        ventimp.document.write("<html><head>");
    //    ventimp.document.write('<meta http-equiv=Content-Type content="text/html; charset=UTF-8"><title>Selkis WEB - Kernel SRL</title>');
    //    ventimp.document.write("<script>");
    //    ventimp.document.write("function Print(){document.body.offsetHeight;window.print()}");
    //    ventimp.document.write("</script>");
    //    ventimp.document.write("</head>");
    //    ventimp.document.write('<body onload="Print()">');
    //    ventimp.document.write(nombre);
    //    ventimp.document.write("</body></html>");*
    }-*/;

    public static native int getScreenWidth() /*-{
    var a = $wnd.screen.width;
    if(a < 1024)
    {
    a = 1024;
    }
    return a;
    }-*/;

    public static native int getScreenHeight() /*-{
    var a = $wnd.screen.height;
    if(a < 768)
    {
    a = 768;
    }
    return a;
    }-*/;

    public static String getStringOfDate(Date fecha) {
        DateTimeFormat fmt = DateTimeFormat.getFormat("yyyy-MM-dd");
        return fmt.format(fecha);
    }
}
