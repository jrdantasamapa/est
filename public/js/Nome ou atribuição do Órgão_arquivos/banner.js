!function () {
    var a, i, r = '\
            <div class="container-fluid hidden-xs hidden-sm">\n\
            <div class="container">\n\
                <div class="row">\n\
                <div class="col-md-12">\n\
                    <div class="carousel slide media-carousel" id="media">\n\
                        <div class="carousel-inner">\n\
                            <div class="item  active">\n\
                                <div class="row">\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="https://www.convenios.gov.br/portal/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/siconv.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://www.transparencia.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_transp.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://www.sic.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_sic.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://www.amapa.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_gov.png"></a>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <div class="item">\n\
                                <div class="row">\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://portaldoservidor.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_servidor.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://agendadoservidor.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_agenda.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://www.edoc.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_edoc.png"></a>\n\
                                    </div>\n\
                                    <div class="col-md-3 col-sm-3">\n\
                                        <a class="thumbnail" href="http://www.processoseletivo.ap.gov.br/" target="_blank"><img class="img-responsive" src="http://prodap.ap.gov.br/padrao/banner/img/banner_processo.png"></a>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>\n\
                        <a data-slide="next" href="#media" class="right carousel-control">›</a>\n\
                    </div>\n\
                </div>\n\
            </div>\n\
        </div>\n\
        </div>\n\
        <div class="container-fluid mapa">\n\
        <div class="container">\n\
        <div class="hidden-xs hidden-sm" id="mapa">\n\
                <div class="col-sm-3 col-md-3" style="border-left: 1px solid #fff">\n\
                <strong>Cidadão</strong><br/>\n\
                    <a href="http://www.caesa.ap.gov.br/areaServ.php" class="branco" target="_blank">2° Via CAESA </a><br/>\n\
                    <a href="http://www.cea.ap.gov.br/index.php?option=com_wrapper&view=wrapper&Itemid=69" class="branco" target="_blank">2° Via CEA </a><br/>\n\
                    Carteira de Identidade <br/>\n\
                    <a href="https://detranamapa.com.br/site/apps/habilitacao/consulta/filtro-consulta-habilitacao-htm.jsp" class="branco" target="_blank">Carteira de Habilitação</a><br/>\n\
                    Boletim de Ocorrência <br/>\n\
                    <a href="https://detranamapa.com.br/site/apps/veiculo/consultas/filtro-consulta-veiculo-htm.jsp" class="branco" target="_blank">Veículos</a><br/>\n\
                    <br/>\n\
                </div>\n\
                <div class="col-sm-3 col-md-3" style="border-left: 1px solid #fff">\n\
                    <strong>Empresas</strong><br/>\n\
                    <a href="http://www.compras.ap.gov.br/" class="branco" target="_blank">Licitações</a><br/>\n\
                    <a href="http://intranet.sre.ap.gov.br/sweb/control?cmd=gov.sre.controle.darum.AMntDarUm" class="branco" target="_blank">DAR Avulso </a><br/>\n\
                    <a href="http://intranet.sre.ap.gov.br/Conta_Corrente/servlet/hcontacorrente" class="branco" target="_blank">DAR Conta Corrente </a><br/>\n\
                    <a href="http://sefaz.ap.gov.br/index.php/nf-e" class="branco" target="_blank">Nota Fiscal Eletrônica </a><br/>\n\
                    <a href="" class="branco" target="_blank">Junta Comercial - Consulta </a><br/>\n\
                    <br/>\n\
                </div>\n\
                <div class="col-sm-3 col-md-3" style="border-left: 1px solid #fff">\n\
                    <strong>Servidores</strong> <br/>\n\
                    <a href="http://www.competencias.ap.gov.br/" class="branco" target="_blank">Banco de Conhecimento</a><br/>\n\
                    <a href="http://www.portaldoservidor.ap.gov.br" class="branco" target="_blank">Contracheque do Estado</a><br/>\n\
                    <a href="http://www.consig.ap.gov.br/autenticacao.php" class="branco" target="_blank">Consignatária On-Line </a><br/>\n\
                    <br/>\n\
                </div>\n\
                <div class="col-sm-3 col-md-3" style="border-left: 1px solid #fff">\n\
                    <strong>Redes Sociais do Governo</strong> <br/>\n\
                    Facebook <br/>\n\
                    Twitter <br/>\n\
                    Instagram <br/>\n\
                    <br/>\n\
            </div>\n\
            </div>\n\
          </div>';
    a = document.getElementById("bannerbaixo"), a && (a.removeAttribute("style"),
            a.innerHTML = r, i = document.getElementsByTagName("head")[0]),
            window._bannerbaixo = {insere_css: function (a) {
                    var r, e, t;
                    return e = document.createElement("style"), t = document.createAttribute("type"),
                            t.value = "text/css", r = document.createAttribute("media"), r.value = "all", e.setAttributeNode(t), e.setAttributeNode(r), e.styleSheet ? e.styleSheet.cssText = a : e.appendChild(document.createTextNode(a)), i.appendChild(e);
                }};
}(), window._bannerbaixo.insere_css('\
            #mapa strong {font-size: 14px; margin-bottom: 5px;}\n\
            #mapa a:link { color: #ffffff }\n\
            #mapa a:visited { color: #ffffff }\n\
            .mapa {background-color: #0f4e96; color: #ffffff; font-size: 12px; padding-top: 15px; padding-bottom:25px}\n\
            .mapa .titulo {font-size: 12px; font-weight: bold}\n\
            .media-carousel {margin-bottom: 0;padding: 0 40px 30px 40px;margin-top: 30px;}\n\
            .media-carousel .carousel-control.left {left: -12px;background-image: none;background: none repeat scroll 0 0 #222222;border: 4px solid #FFFFFF;border-radius: 23px 23px 23px 23px;height: 40px;width : 40px;margin-top: 30px}\n\
            .media-carousel .carousel-control.right {right: -12px !important;background-image: none;background: none repeat scroll 0 0 #222222;border: 4px solid #FFFFFF;border-radius: 23px 23px 23px 23px;height: 40px;width : 40px;margin-top: 30px}\n\
            .media-carousel .carousel-indicators {right: 50%;top: auto;bottom: 0px;margin-right: -19px;}\n\
            .media-carousel .carousel-indicators li {background: #c0c0c0;}\n\
            .media-carousel .carousel-indicators .active {background: #333333;}\n\
'), !function () {
};