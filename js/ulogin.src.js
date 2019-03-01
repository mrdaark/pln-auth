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
        let query="";
        for (let key in param)
        {
            query+='&'+key+'='+param[key];
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST",backend_url+'?act=login',true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(query);
        //xhr.send();

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
                    console.log('ошибка',user.error);
                    switch (user.error.code)
                    {
                        case 102:
                            if (user.error.time===4294967295)
                            {
                                alert('Пользователь блокирован навсегда');
                            }
                            else
                            {
                                alert('Пользователь блокирован до '+ new Date(user.error.time * 1000).toLocaleString('ru',{ day: 'numeric', month: 'long', year:'numeric', hour:'numeric', minute: 'numeric',
                                second: 'numeric', timezone:'MSK'})); 
                            }
                            
                        break;
                    }

                    switch_state ('logout');
                }                
                
            }
        }
    };

    const send_request = (phone,cd,rb,ab,ip) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST",backend_url+'?act=send_request',true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('phone='+phone.replace('+','')+'&time='+Date.now());

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
                    const div = document.querySelector("#auth_form");
                    const div_code = document.querySelector("#auth_form_code");
                    
                    div_code.style.display='block';
                    div.style.height='250px';
                    div.style.marginTop='-125px';
                    
                    let not_all_info=false;
                    //если у нас не заполнены поля инфомации, то добавим к форме нужные поля.
                    if (responce.last_name==='' || responce.first_name==='')
                    {
                        div.style.height='360px';
                        div.style.marginTop='-180px';
                        //Имя
                        const div_fname = create_input('fname','Имя',responce.first_name);       
                        div.insertBefore(div_fname,document.querySelector("#auth_buttons"));

                        //Фамилия
                        const div_lname = create_input('lname','Фамилия',responce.last_name);
                        div.insertBefore(div_lname,document.querySelector("#auth_buttons"));

                        not_all_info=true;
                    }
                    
                    ab.addEventListener('click',()=>{                
                        const code = document.querySelector("#auth_code").value;
                        const fname_input = document.querySelector("#auth_fname");
                        const lname_input = document.querySelector("#auth_lname"); 

                        let fname='';
                        let lname='';

                        if (not_all_info) {
                            if (fname_input===null || lname_input===null)
                            {
                                alert("Ошибка формы ввода данных. Перезагрузите страницу.");
                                return false;
                            }
                            
                            fname = fname_input.value;
                            lname = lname_input.value;

                            if (fname==='' || lname==='')
                            {
                                alert('Необходимо ввести данные');
                                return false;
                            }
                        }

                        if (!/^\d{5}$/.test(code))
                        {
                            alert('Код из SMS должен состоять из 5 цифр');
                            return false;
                        }

                        const query = {
                            phone:phone.replace('+',''),
                            code:code,
                            mode:'sms'
                        };

                        if (fname !== '')
                        {
                            query.first_name=fname;
                        }

                        if (lname !== '')
                        {
                            query.last_name=lname;
                        }
                        
                        getInfo(query);
                    });
                }
                else
                {
                    if (responce.error.code=='1')
                    {
                        alert('Ошибка в формате номера телефона');
                        clearInterval(cd);
                        rb.innerHTML="Запросить код";
                        rb.disabled=false;
                        ab.disabled=true;
                        ip.disabled=false;
                    }
                    else if (responce.error.code=='2')
                    {
                        alert('Ошибка отправки SMS, попробуйте еще раз');
                        clearInterval(cd);
                        rb.innerHTML="Запросить код";
                        rb.disabled=false;
                        ab.disabled=true;
                        ip.disabled=false;
                    }
                    else if (responce.error.code=='3')
                    {
                        alert('Ошибка в отправленном запросе, попробуйте позже');
                        clearInterval(cd);
                        rb.innerHTML="Запросить код";
                        rb.disabled=false;
                        ab.disabled=true;
                        ip.disabled=false;
                    } 
                    else if (responce.error.code=='4')
                    {
                        alert('Время для повторного запроса еще не наступило');
                        ab.disabled=true;
                    }                                 
                    else {
                        alert("Неопознанная ошибка, попробуйте позже");
                    }
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
                if (user.network!=='smsc.ru' && user.network!=='facebook' && user.profile!=='')
                {
                    elements[i].profile_link.href=user.profile;
                }
                else
                {
                    elements[i].profile_link.href="javascript:void(0);"; 
                    elements[i].profile_link.onclick="return false;";
                    elements[i].profile_link.target="";
                }
                if (user.network==='smsc.ru')
                {
                    elements[i].profile_link.addEventListener('click',(evt)=>{
                        evt.preventDefault();
                        profile_form(user);
                    });   
                }
                
                elements[i].profile_link.innerHTML=user.first_name+' '+user.last_name;
                elements[i].ulogin_info.style.display="block";
        
                elements[i].ulogin_form.style.display='none';
        
                //еще надо установить значение hidden input
                elements[i].input_name.value=user.first_name+' '+user.last_name;
                elements[i].ulogin_identity.value=user.id;
        
                //и разрешить кнопку
                elements[i].forum_submit.onclick = () => true;
            }
            //картинку поменять...
            [...document.querySelectorAll(".profile_image")].map(el=>el.style.backgroundImage="url("+user.image+")");

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
            getInfo({mode:'auth'});
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

    const profile_form = (u) => {
        
        remove_form();
      
        const div = document.createElement('div');
        div.id='auth_form';
        div.style.height='300px';
        div.style.marginTop='-150px';

        const h = document.createElement('p');
        h.className='auth_form_header';
        h.innerHTML='Данные профиля';
        div.appendChild(h);

        const img = document.createElement('img');
        img.src=u.image;
        img.id='profile_avatar';
        div.appendChild(img);

        //Имя
        const div_fname = create_input('fname','Имя',u.first_name);       
        div.appendChild(div_fname);

        //Фамилия
        const div_lname = create_input('lname','Фамилия',u.last_name);
        div.appendChild(div_lname);

        //надо бы сделать загрузку фото, но это потом, может быть.
        const div_image = create_input('image','Выберите фотографию',u.image);
        const image_input=div_image.getElementsByTagName('input')[0];
        image_input.type='file';
        image_input.accept='image/*';

        image_input.addEventListener('change',()=>{
            console.log(image_input.files);
            //сделать upload и поменять картинку...

            const image = new FormData();
            image.append('photo',image_input.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open("POST",backend_url+'?act=upload_image',true);
            //xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(image);

            xhr.onreadystatechange = () => {
                if (xhr.readyState!==4) {return;}
                if (xhr.status !== 200) {
                    console.log(xhr.status + ': ' + xhr.statusText);
                } else {
                    user = JSON.parse(xhr.responseText);
                    if (user.error === undefined) {
                        //поменять картинку
                        img.src=user.image;
                        //и на основной странице...
                        [...document.querySelectorAll(".profile_image")].map(el=>el.style.backgroundImage="url("+user.image+")");
                    } else {
                        alert("Ошибка загрузки картинки");
                    }
                }
            }

        
        });

        div_image.classList.add('auth_profile_image');

        div.appendChild(div_image);

        //Кнопка
        const auth_button = document.createElement('button');
        auth_button.id="auth_button";
        auth_button.innerHTML='Сохранить';
        auth_button.className='auth_button';

        auth_button.addEventListener('click',()=> {
            console.log('here');
            //сохранить это безобразие
            const xhr = new XMLHttpRequest();

            const token=getCookie('auth_token');
            const first_name=div_fname.getElementsByTagName('input')[0].value;
            const last_name=div_lname.getElementsByTagName('input')[0].value;
            if (first_name.trim()==='' || last_name.trim()==='')
            {
                alert("Необходимо заполнить все поля.");
                return false;
            }

            xhr.open("POST",backend_url+'?act=update_profile',true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('token='+token+'&last_name='+last_name+'&first_name='+first_name);
    
            xhr.onreadystatechange = () => {
                if (xhr.readyState!==4) {return;}
                if (xhr.status !== 200) {
                    console.log(xhr.status + ': ' + xhr.statusText);
                } else {
                    user = JSON.parse(xhr.responseText);
                    if (user.error===undefined)
                    {
                        switch_state('login');
                        remove_form();
                    }
                    else
                    {
                        alert("Ошибка сохранения профиля: "+user.error[0].text);
                    }
                }
            };
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

        input_phone.focus();

        const div_code = create_input('code','Код из SMS','');
        div_code.style.display = 'none';
        
        div.appendChild(div_code);

        const div_button = document.createElement('div');
        div_button.className='auth_form_item';
        div_button.id='auth_buttons';

        const auth_button = document.createElement('button');
        auth_button.id="auth_button";
        auth_button.innerHTML='Войти';
        auth_button.className='auth_button';
        auth_button.disabled=true;
        
        const request_button = document.createElement('button');
        request_button.id="request_button";
        request_button.innerHTML='Запросить код';
        request_button.className='auth_button';

        div_button.appendChild(request_button);
        div_button.appendChild(auth_button);

        div.appendChild(div_button);

        let countdown;

        const request_code = () => {
            //console.log('login');
            //проверим формат
            const phone = document.querySelector('#auth_phone').value;
            if (/^\+\d{11,13}$/.test(phone))
            {
                
                //запуск обратного отсчета
                let delay = 150;
                clearInterval(countdown);
                countdown = setInterval(() => {
                    delay-=1;
                    if (delay>0)
                    {
                        let sec = (delay%60<10) ? '0'+delay%60:delay%60;
                        let time = Math.floor(delay/60)+':'+ sec;
                        request_button.innerHTML="Запросить код "+time;
                    }
                    else
                    {
                        clearInterval(countdown);
                        request_button.innerHTML="Запросить код";
                        request_button.disabled=false;
                    }
                }, 1000);

                send_request(phone,countdown,request_button,auth_button,input_phone);

                input_phone.disabled=true;

                auth_button.disabled = false;
                request_button.disabled = true;

                h.innerHTML='Введите код из SMS';
            }
            else
            {
                alert('Неправильный номер телефона');
            }
        }

        request_button.addEventListener('click',request_code);

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