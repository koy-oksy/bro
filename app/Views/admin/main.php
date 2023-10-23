<div class="clearfix"></div>
<div class="page-title">
    <div class="">
        <div class="col-sm-12 col-md-6">
            <h3>Шаблон головної сторінки</h3>
        </div>
        <div class="col-sm-12 col-md-6" style="padding: 10px">
            Шрифт:
            <select id="selectFont">
                <option>Roboto Mono</option>
                <option>Consolas</option>
                <option>Cascadia Mono</option>
                <option>Inconsolata</option>
                <option>Source Code Pro</option>
                <option>IBM Plex Mono</option>
                <option>Space Mono</option>
                <option>PT Mono</option>
                <option>Ubuntu Mono</option>
                <option>Nanum Gothic Coding</option>
                <option>Cousine</option>
                <option>Fira Mono</option>
                <option>Share Tech Mono</option>
                <option>Courier Prime</option>
                <option>Anonymous Pro</option>
                <option>Cutive Mono</option>
                <option>VT323</option>
                <option>JetBrains Mono</option>
                <option>Noto Sans Mono</option>
                <option>Red Hat Mono</option>
                <option>Martian Mono</option>
                <option>Major Mono Display</option>
                <option>Nova Mono</option>
                <option>Syne Mono</option>
                <option>Xanh Mono</option>
                <option>Monofett</option>
            </select>
            Розмір шрифту:
            <input id="inputFontSize" type="number" step=".1" value="12" style="width: 50px;" />
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="x_panel">
        <div class="x_content">
            {!form_open!}

            <input type="hidden" value="{template_content}" id="html"/>
            <input id="selectStyle" type="hidden" value="vs2015.min.css"/>
            <input id="selectLanguage" type="hidden" value="language-html"/>
            
            <div id="divCodeWrapper">
                <pre id="preCode"><code id="codeBlock" class="language-html"></code></pre>
                <textarea id="textarea1" wrap="soft" spellcheck="false" name="template_code"></textarea>
            </div>
            
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-4">
                    <button class="btn btn-primary reset_template" template_name="{template_name}" type="button"><i class="fa fa-close"></i> Скинути зміни</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Зберігти зміни</button>
                </div>
            </div>
            {!form_close!}
        </div>
    </div>
</div>