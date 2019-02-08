const auth_module = (function() {
    
 
    const backend_url='/ulogmy83_l.php';
    
    const elements = []; //здесь будем хранить ссылки на нужные элементы DOM, заполним по готовности DOM
    
    const setElements = () => {
        elements[0]={
            ulogin_button : "uLogin_up",
            ulogin_form : document.querySelector("#ulogin_form_up"),
            ulogin_info : document.querySelector("#ulogin_info_up"),
            ulogin_identity : document.querySelector("#ulogin_identity_up"),
            profile_link: document.querySelector("#profile_link_up"),
            forum_submit : document.querySelector("#forum_submit_up"),
            input_name : document.querySelector("#forum_name_up"),
        };
        elements[1]={
            ulogin_button : "uLogin_down",
            ulogin_form : document.querySelector("#ulogin_form_down"),
            ulogin_info : document.querySelector("#ulogin_info_down"),
            ulogin_identity : document.querySelector("#ulogin_identity_down"),
            profile_link: document.querySelector("#profile_link_down"),
            forum_submit : document.querySelector("#forum_submit_down"),
            input_name : document.querySelector("#forum_name_down"),
        };
    };

    //console.clear();

    const getCookie = (name) => {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    };

    let user = {};

    const getInfo = (param) => {
        // const token = param.token;
        // const mode = param.mode;
        // const provider = param.provider;

        let query="";
        for (let key in param)
        {
            query+='&'+key+'='+param[key];
        }
        
        const xhr = new XMLHttpRequest();
        xhr.open("GET",backend_url+'?act=login'+query,true);
        //xhr.open("GET",backend_url+'?act=login&provider='+provider+'&token='+token+'&mode='+mode,true);
        //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //xhr.send('token='+token+'&mode='+mode);
        xhr.send();

        xhr.onreadystatechange = () => {
            if (xhr.readyState!==4) {return;}
            if (xhr.status !== 200) {
                console.log(xhr.status + ': ' + xhr.statusText);
            } else {
                user = JSON.parse(xhr.responseText);
                if (user.error === undefined) {

                    //если у нас нет данных пользователя, то попросим его их ввести
                    if (user.last_name.trim()==='' || user.first_name.trim()==='')
                    {
                        profile_form(user);
                    }
                    else
                    {
                        switch_state ('login');
                    }
                } else {
                    console.log('ошибка токена',user.error);
                    switch_state ('logout');
                }                
                
            }
        }
    };

    const check_phone = (phone) => {
        const xhr = new XMLHttpRequest();
        xhr.open("GET",backend_url+'?act=checkphone&phone='+phone,true);
        xhr.send();

        xhr.onreadystatechange = () => {
            if (xhr.readyState!==4) {return;}
            if (xhr.status !== 200) {
                console.log(xhr.status + ': ' + xhr.statusText);
            }
            else 
            {
                const responce = JSON.parse(xhr.responseText);
                if (responce.error===undefined)
                {
                    //тут надо запустить что-то
                    document.querySelector('#auth_button').addEventListener('click',()=>{                
                        const code = document.querySelector("#auth_code").value;
                        getInfo({token:responce.code_token,code:code,mode:'smsc',provider:'smsc'});
                    });
                }
                else
                {
                    //todo: пришла ошибка, надо ее обработать... 
                }
            }
        }

    };

    const ulogin_callback = (token) => getInfo({token:token,mode:'ulogin',provider:'ulogin'});

    const switch_state = (state) => {
        //login || logout
        if (state === 'login') {
            remove_form();

            for (let i=0;i<elements.length;i+=1)
            {
                elements[i].profile_link.href=user.identity;
                elements[i].profile_link.innerHTML=user.first_name+' '+user.last_name;
                elements[i].ulogin_info.style.display="block";
        
                elements[i].ulogin_form.style.display='none';
        
                //еще надо установить значение hidden input
                elements[i].input_name.value=user.first_name+' '+user.last_name;
                elements[i].ulogin_identity.value=user.id;
        
                //и разрешить кнопку
                elements[i].forum_submit.onclick = () => true;
            }

        }
        else
        {
            for (let i=0;i<elements.length;i+=1)
            {
                //чистим данные в форме
                elements[i].input_name.value='';
                elements[i].ulogin_identity.value='';

                //убираем инфу о пользователе
                elements[i].ulogin_info.style.display="none";
                elements[i].profile_link.href="";
                elements[i].profile_link.innerHTML="";

                //показываем кнопку входа и вешаем обработчик на вывод сообщения о необходимости входа на кнопку
                elements[i].ulogin_form.style.display='block';
                elements[i].forum_submit.onclick = noLoginMessage;
            }
        }
    }

    const logout = () => {
        const xhr = new XMLHttpRequest();
        xhr.open("GET",backend_url+"?act=logout",true);
        //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send();

        xhr.onreadystatechange = () => {
            if (xhr.readyState!==4) {return;}
            if (xhr.status !== 200) {
                console.log(xhr.status + ': ' + xhr.statusText);
            } else {
                user = {};
                switch_state('logout');
            }
        }
    };

    const loadCSS = () => {
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = '/css/forum.css';
        head.appendChild(link);
    };

    document.addEventListener('DOMContentLoaded', () => {

        //loadCSS();

        //получим токен
        const token = getCookie('auth_token');

        setElements();

        uLogin.customInit('uLogin_up','uLogin_down', {
            redirect_uri: "",
            display: "panel",
            theme: "classic",
            fields: "first_name,last_name,profile,photo",
            providers: "vkontakte,facebook,google,odnoklassniki",
            hidden: "",
            redirect_uri: "",
            mobilebuttons: 0,
            callback: "ulogin_callback"
        });

        if (token !== undefined)
        {
            //console.log('у нас есть токен');
            //в таком случае делаем сразу callback
            getInfo({token:token,mode:'auth',provider:'local'});
        }
        else
        {
            switch_state('logout');
        }

        //create_phone_form();

        [...document.querySelectorAll(".phone_auth_form")].map(el => el.addEventListener("click",phone_auth_form));

    });

    const noLoginMessage = () => {
        alert("Нужно войти, чтобы оставлять комментарии");
        return true;
    };

    const phone_auth_form = (evt) => {
        
        evt.preventDefault();
        console.log('phone auth');
        create_phone_form();
    };

    const format_phone = (value) => {

        //зашибем все лишнее
        value = value.replace(/^\d*/gim,'');
        
        //если поле пустое - добавим +
        if (value==='')
        {
            value='+';
        }

        //если первый символ не +, но добавим его к номеру
        if (value[0]!=='+')
        {
            value='+'+value;
        }

        //если дальше какая-то фигня, то убираем ее 
        if(!/^\+\d*$/.test(value))
        {
            value = '+';
        }
        return value;
    };

    const remove_form = () => {

        console.log(document.querySelector("#auth_form"));

        if (document.querySelector("#auth_form")!==null)
        {
            document.querySelector("#auth_form").remove();
        }
        if (document.querySelector(".body-overlay")!==null)
        {
            document.querySelector(".body-overlay").remove();
        }
    };

    const create_input = (prefix,name,value) => {
        
        const div = document.createElement('div');
        div.className='auth_form_item';
        div.id='auth_form_'+prefix;

        const input = document.createElement('input');
        input.name = 'auth_'+prefix;
        input.className='auth_form_input';
        input.value=value;
        input.id='auth_'+prefix;
        input.required=true;

        const label = document.createElement('label');
        label.for="auth_"+prefix;
        label.className='auth_form_label';
        label.innerHTML=name;

        div.appendChild(input);
        div.appendChild(label);

        return div;
    };

    const profile_form = (user) => {
        
        remove_form();
      
        const div = document.createElement('div');
        div.id='auth_form';
        div.style.height='250px';
        div.style.marginTop='-125px';

        const h = document.createElement('p');
        h.className='auth_form_header';
        h.innerHTML='Введите данные';

        div.appendChild(h);

        //Имя
        const div_fname = create_input('fname','Имя',user.first_name);       
        div.appendChild(div_fname);

        //Фамилия
        const div_lname = create_input('lname','Фамилия',user.last_name);
        div.appendChild(div_lname);

        //надо бы сделать загрузку фото, но это потом, может быть.

        //Кнопка
        const auth_button = document.createElement('button');
        auth_button.id="auth_button";
        auth_button.innerHTML='Сохранить';
        auth_button.addEventListener('click',()=> {
            getInfo({
                user: user.id,
                first_name: document.querySelector("#auth_fname").value,
                last_name: document.querySelector("#auth_lname").value,
                mode: 'profile',
                provider: 'sms',
                token: getCookie('profile_token'),
            });
        });

        div.appendChild(auth_button);

        //подложка
        const overlay=document.createElement('div');
        overlay.className='body-overlay';

        overlay.addEventListener('click',()=>{
            overlay.remove();
            div.remove();
        });

        document.body.appendChild(overlay);
        document.body.appendChild(div);

    };

    const create_phone_form = () => {       
        const div = document.createElement('div');
        div.id='auth_form';

        const h = document.createElement('p');
        h.className='auth_form_header';
        h.innerHTML='Введите номер телефона';

        div.appendChild(h);

        //номер телефона
        const div_phone = create_input('phone','Номер телефона','');
        const input_phone = div_phone.getElementsByTagName('input')[0];
        
        input_phone.addEventListener('input',(evt)=>{
            input_phone.value=format_phone(input_phone.value);
        });

        input_phone.addEventListener('focus', () => {
            input_phone.value=format_phone(input_phone.value);
        });
        
        div.appendChild(div_phone);

        const div_code = document.createElement('div');
        div_code.className='auth_form_item';
        div_code.id='auth_form_code';
        div_code.style.display='none';

        const input_code = document.createElement('input');
        input_code.name = 'auth_code';
        input_code.className='auth_form_input';
        input_code.id='auth_code';
        input_code.required=true;

        const label_code = document.createElement('label');
        label_code.for="auth_code";
        label_code.className='auth_form_label';
        label_code.innerHTML="Код из SMS";

        div_code.appendChild(input_code);
        div_code.appendChild(label_code);

        div.appendChild(div_code);

        const auth_button = document.createElement('button');
        auth_button.id="auth_button";
        auth_button.innerHTML='Запросить код';

        const request_code = () => {
            console.log('login');

            //проверим формат
            const phone = document.querySelector('#auth_phone').value;
            if (/\+\d{11,13}/.test(phone))
            {
                console.log(phone);
                check_phone(phone);

                div_code.style.display='block';
                div.style.height='250px';
                div.style.marginTop='-125px';
                input_phone.disabled=true;
                auth_button.innerHTML='Войти';
                h.innerHTML='Введите код из SMS';

                auth_button.removeEventListener('click',request_code);

                //нужно еще блокировать кнопку до получения ответ и перевесить на ней 
            }
            else
            {
                alert('Неправильный номер телефона');
            }
        }

        auth_button.addEventListener('click',request_code);
 
        div.appendChild(auth_button);

        const overlay=document.createElement('div');
        overlay.className='body-overlay';

        overlay.addEventListener('click',()=>{
            overlay.remove();
            div.remove();
            // overlay.style.display='none';
            // div.style.display='none';
        });

        document.body.appendChild(overlay);
        document.body.appendChild(div);
    };

    return {
        callback : ulogin_callback,
        logout: logout,
        phone_auth_form: phone_auth_form
    };

})();

var ulogin_callback = auth_module.callback;
var ulogin_logout = auth_module.logout;
var phone_auth_form = auth_module.phone_auth_form;