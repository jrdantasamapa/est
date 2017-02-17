!function () {
    var a, i, r = '\
    <meta name="theme-color" content="#0f4e96"/>\n\
        <nav class="navbar navbar-default">\n\
             <div class="container">\n\
                <a class="navbar-brand bandeira" href="#" target="_blank"><img alt="Brand" src="http://prodap.ap.gov.br/padrao/barra/img/bandeira2.png"></a>\n\
                <a href="http://www.amapa.gov.br" target="_blank" class="navbar-text amapa pull-left"><strong>AMAPÁ</strong></a>\n\
                <div class="nav navbar-nav navbar-right visible-lg visible-md visible-sm">\n\
                <a href="http://www.ppa.ap.gov.br" target="_blank" class="navbar-text fonte-links">\n\
                    <a href="http://webmail.amapa.gov.br" target="_blank" class="navbar-text fonte-links">\n\
                    <strong><i class="fa fa-envelope-o"></i> WEBMAIL</strong></a>\n\
                    <span class="navbar-text fonte-links"><strong>|</strong></span>\n\
                    <span class="navbar-text fonte-links"><strong><i class="fa fa fa-sitemap"></i> SERVIÇOS</strong></span>\n\
                        <div style="margin-top:10px; float:right">\n\
                            <form class="navbar-left orgaos">\n\
                            <select id="orgaosgov" class="form-control orgaos chosen-select" onchange="if (options[selectedIndex].value) { window.self.location.href = options[selectedIndex].value; }" title="Órgãos do Governo" name="orgaosgov" style="width:250px;" tabindex="2" ><option value="" selected="selected">&Oacute;rg&atilde;os Governamentais</option>\n\
                                <option value="http://www.sead.ap.gov.br" >Administra&ccedil;&atilde;o</option>\n\
                                <option value="http://www.afap.ap.gov.br">Ag&ecirc;ncia de Fomento</option>\n\
                                <option value="http://www.seab.ap.gov.br">Brasilia</option>\n\
                                <option value="http://www.prodap.ap.gov.br">Tecnologia de Informação</option>\n\
                                <option value="http://www.setec.ap.gov.br">Ci&ecirc;ncia e Tecnologia</option>\n\
                                <option value="http://www.caesa.ap.gov.br">Companhia de &aacute;gua</option>\n\
                                <option value="http://www.cea.ap.gov.br">Companhia Eletricidade</option>\n\
                                <option value="http://www.cge.ap.gov.br/">Controladoria Geral</option>\n\
                                <option value="http://www.cbm.ap.gov.br">Corpo de Bombeiros</option>\n\
                                <option value="http://www.rurap.ap.gov.br/">Desenvolvimento Rural</option>\n\
                                <option value="http://www.seed.ap.gov.br">Educa&ccedil;&atilde;o</option>\n\
                                <option value="http://www.eap.ap.gov.br/">Escola de Administra&ccedil;&atilde;o</option>\n\
                                <option value="http://www.ief.ap.gov.br/">Instituto de Florestas</option>\n\
                                <option value="http://www.hemoap.ap.gov.br">Instituto de Hematologia</option>\n\
                                <option value="http://www.iepa.ap.gov.br">Inst. de Pesq. Científicas e Tecnológicas</option>\n\
                                <option value="http://www.terrap.ap.gov.br">Instituto de Terras</option>\n\
                                <option value="http://www.rurap.ap.gov.br/">Instituto Rural</option>\n\
                                <option value="http://www.jucap.ap.gov.br">Junta Comercial</option>\n\
                                <option value="http://www.juventude.ap.gov.br">Juventude</option>\n\
                                <option value="http://www.lacen.ap.gov.br">Laborat&oacute;rio Central</option>\n\
                                <option value="http://www.sema.ap.gov.br">Meio Ambiente</option>\n\
                                <option value="http://www.sims.ap.gov.br">Mobiliza&ccedil;&atilde;o Social</option>\n\
                                <option value="http://www.ipem.ap.gov.br">Pesos e Medidas</option>\n\
                                <option value="http://www.seplan.ap.gov.br">Planejamento</option>\n\
                                <option value="http://www.policiacivil.ap.gov.br">Policia Civil</option>\n\
                                <option value="http://www.pm.ap.gov.br">Policia Militar</option>\n\
                                <option value="http://www.politec.ap.gov.br">Policia T&eacute;cnica</option>\n\
                                <option value="http://www.procon.ap.gov.br/">Procon</option>\n\
                                <!--<option value="http://www.amapajovem.ap.gov.br">Prog. Amap&aacute; Jovem</option>-->\n\
                                <option value="http://www.difusora.ap.gov.br">Radio Difusora</option>\n\
                                <option value="http://www.sefaz.ap.gov.br">Receita</option>\n\
                                <option value="http://www.saude.ap.gov.br">Sa&uacute;de</option>\n\
                                <!--<option value="http://www.sisp.ap.gov.br/">Seguran&ccedil;a P&uacute;blica</option>-->\n\
                                <!--<option value="http://www.superfacil.ap.gov.br">Super F&aacute;cil</option>-->\n\
                                <option value="http://www.ap.gov.br">Trabalho</option>\n\
                                <option value="http://www.detran.ap.gov.br">Tr&acirc;nsito</option>\n\
                                <option value="http://www.setrap.ap.gov.br">Transporte</option>\n\
                                <option value="http://www.setur.ap.gov.br">Turismo</option>\n\
                                <option value="http://www.ueap.ap.gov.br">Universidade Estadual</option>\n\
                            </select>\n\
                            </form>\n\
                        </div>\n\
                    </div>\n\
                </div>\n\
            </div>\n\
        </nav>';
    a = document.getElementById("topo"), a && (a.removeAttribute("style"),
            a.innerHTML = r, i = document.getElementsByTagName("head")[0]),
            window._barrabrasil = {insere_css: function (a) {
                    var r, e, t;
                    return e = document.createElement("style"), t = document.createAttribute("type"),
                            t.value = "text/css", r = document.createAttribute("media"), r.value = "all", e.setAttributeNode(t), e.setAttributeNode(r), e.styleSheet ? e.styleSheet.cssText = a : e.appendChild(document.createTextNode(a)), i.appendChild(e);
                }};
}(), window._barrabrasil.insere_css('\
            a:link { text-decoration: none}\n\
            body { padding-top:50px }\n\
            .navbar-default { background-color:#0f4e96;background-repeat:border:0; border-radius: 0;\n\
            z-index: 1}\n\
            .navbar-text { color: #FFFFFF !important; margin-right: -2px !important}\n\
            .arraia {margin-left:20px; margin-top:5px}\n\
            .amapa {margin-left: 0px !important; \n\
            font-size: 14px}\n\
            .bandeira {margin-top: 0px; padding-left: 0}\n\
            .orgaos { margin: 5px 0 0 15px}\n\
            .fonte-links { font-size: 12px; padding-top: 3px}\n\
            .fixo{position:fixed;width:100%;z-index:999;top:0;margin-bottom: 40px}\n\
            \n\
'), !function () {
};