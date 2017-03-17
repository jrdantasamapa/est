<?php
@session_start();
/*
 * API Para download de XML da NF-e direto pelo site da secretária da fazenda
 */
/**
 * Description of DownloadNFeSefaz
 *
 * @author Edimário Gomes <edi.gomes00@gmail.com>
 * @license GPL
 */
class DownloadNfeSefaz {
    
    private $cookie;
    
    /**
     * CNPJ da empresa emitente 
     * @var String
     */
    private $CNPJ;
    
    /**
     * Pasta onde se encontram os arquivos .pem
     * {CNPJ}_priKEY.pem
     * {CNPJ}_certKEY.pem
     * {CNPJ}_pubKEY.pem
     * do certificado A1 (pasta certs do nfe php)
     * ($this->aConfig['pathCertsFiles'])
     * @var type String
     */
    private $pathCertsFiles;
    
    /**
     * Senha do certificado
     * @var type 
     */
    private $certPass;
    
    public function __construct(){
        $this->cookie  =  realpath(dirname(__FILE__)) .  'cookies_curl_nfe_sefaz'. uniqid().'.txt';
        $_SESSION['classDownloadNfeSefaz'] = serialize($this);
    }
    
    public static function getInstance( $new = false ){
        if( $new ){
            return new DownloadNfeSefaz();
        }
        
        if(isset($_SESSION['classDownloadNfeSefaz'])){
            $obj = unserialize($_SESSION['classDownloadNfeSefaz']);
            if(!($obj instanceof DownloadNfeSefaz) ){
                return new DownloadNfeSefaz();
            }else{
                return $obj;
            }
        }else{
            return new DownloadNfeSefaz();
        }
    }
    
    public function teminated(){
        @unlink($this->cookie);
        unset($_SESSION['classDownloadNfeSefaz']);
    }

    /**
     * Retorna o captcha da sefaz para download do XML
     * no formato base64 (png)
     * @return String base64 png
     */
    public function getDownloadXmlCaptcha() {
        //@session_start();
        // Passo 1
        $url = "http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=";

        $useragent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.2 (KHTML, like Gecko) Chrome/5.0.342.3 Safari/533.2';
        /* Get __VIEWSTATE & __EVENTVALIDATION */
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_COOKIEJAR , $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        $html = curl_exec($ch);
        curl_close($ch);
        
        $_viewstate = array();
        $_stategen = array();
        $_eventValidation = array();
        $_sstoken = array();
        $_captcha = array();
        
        preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $_viewstate);
        preg_match('~<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="(.*?)" />~', $html, $_stategen);
        preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $_eventValidation);
        preg_match('~<input type="hidden" name="ctl00\$ContentPlaceHolder1\$token" id="ctl00_ContentPlaceHolder1_token" value="(.*?)" />~', $html, $_sstoken);
        preg_match('~<img id=\"ctl00_ContentPlaceHolder1_imgCaptcha\" src=\"(.*)\" style~', $html, $_captcha);
        
        // TODO: Verificar se a página do captcha foi carregada
        $stategen = $_stategen[1];
        $_SESSION['stategen'] = $stategen;
        
        $token = $_sstoken[1];
        $_SESSION['token'] = $token;
        
        $viewstate = $_viewstate[1];
        $_SESSION['viewstate'] = $viewstate;
        
        $eventValidation = $_eventValidation[1];
        $_SESSION['eventValidation'] = $eventValidation;
        
        $captcha = $_captcha[1];
        return $captcha;
        
    }
    

    /**
     * Faz o download da NF-e no site da sefaz usando o certificado digital do cliente
     * @param type $txtCaptcha Captcha fornecedo por getDownloadXMLCaptcha
     * @param type $chNFe Chave de acesso da NF-e
     * @return String XML da NF-e
     */
    public function downloadXmlSefaz($txtCaptcha, $chNFe, $CNPJ, $pathCertsFiles, $certPass) {
        
        // TODO: Validar CNPJ
        $this->CNPJ = $CNPJ;
        // TODO: Validar se existe a pasta e os arquivos .pem
        $this->pathCertsFiles = $pathCertsFiles;
        // TODO: Validar senha do certificado
        $this->certPass = $certPass;
        
        // TODO: validar chNFe 44 digitos
        
        @session_start();
        // URL onde a sefaz fornece o botão de download
        $url = "http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=";
        // Arquivo de coockie para armazenar a session
//        $this->cookie  = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'cookies1.txt';
        // Simula um browser pelo curl
        $useragent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36';
        /* Start Login process */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_COOKIEJAR , $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($ch, CURLOPT_STDERR, $f);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        // Collecting all POST fields
        $postfields = array();
        $postfields['__EVENTTARGET'] = "";
        $postfields['__EVENTARGUMENT'] = "";
        $postfields['__VIEWSTATE'] = $_SESSION['viewstate'];
        $postfields['__VIEWSTATEGENERATOR'] = $_SESSION['stategen'];
        $postfields['__EVENTVALIDATION'] = $_SESSION['eventValidation'];
        
        $postfields['ctl00$txtPalavraChave'] = "";
        
        $postfields['ctl00$ContentPlaceHolder1$txtChaveAcessoCompleta'] = $chNFe;
        $postfields['ctl00$ContentPlaceHolder1$txtCaptcha'] = $txtCaptcha;
        $postfields['ctl00$ContentPlaceHolder1$btnConsultar'] = 'Continuar';
        $postfields['ctl00$ContentPlaceHolder1$token'] = $_SESSION['token'];
        $postfields['hiddenInputToUpdateATBuffer_CommonToolkitScripts'] = '1';
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        $html = curl_exec($ch); // Get result after login page.
        curl_close($ch);
        
        //echo $html;
        
        /* ENTRA NA INFO DA NFE */
        $ch = curl_init();
        $url_det_nfe = 'http://www.nfe.fazenda.gov.br/portal/consultaCompleta.aspx?tipoConteudo=XbSeqxE8pl8=';
        
        curl_setopt($ch, CURLOPT_URL, $url_det_nfe);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_COOKIEJAR , $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($ch, CURLOPT_STDERR, $f);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        //curl_setopt($ch, CURLOPT_POST, 1);
        
        $html = curl_exec($ch); // Get result after login page.
        curl_close($ch);
        /****/
        
        preg_match('~Chave de Acesso~', $html, $tagTeste);
        preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
        preg_match('~<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="(.*?)" />~', $html, $stategen);
        preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);
        $stategen = $stategen[1];
        $viewstate = $viewstate[1];
        $eventValidation = $eventValidation[1];
        
        try {
            $tagDownload = $tagTeste[0];
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível fazer o download do XML, por favor atualize o captcha e tente novamente (sessão expirada)');
        }
        
        // Parãmetro teste para saber se a página veio corretamente
        if ($tagDownload == "Chave de Acesso") {
        
            // URL onde a sefaz fornece o download do xml
            $url_download = "http://www.nfe.fazenda.gov.br/portal/consultaCompleta.aspx?tipoConteudo=XbSeqxE8pl8=";
            // Verifica se o certificado existe na pasta
            if (!file_exists($this->pathCertsFiles . $this->CNPJ .'_priKEY.pem') ||
                !file_exists($this->pathCertsFiles . $this->CNPJ .'_priKEY.pem') ||
                !file_exists($this->pathCertsFiles . $this->CNPJ .'_priKEY.pem')) {
                throw new \Exception('Certificado digital não encontrado na pasta: ' . $this->pathCertsFiles . '!');
            }
            
            /**
            Download xml
            */
            $ch_download = curl_init();
            curl_setopt($ch_download, CURLOPT_URL, $url_download);
            curl_setopt($ch_download, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch_download, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch_download, CURLOPT_COOKIEJAR , $this->cookie);
            curl_setopt($ch_download, CURLOPT_COOKIEFILE, $this->cookie);
            curl_setopt($ch_download, CURLOPT_HEADER, TRUE);
            // this with CURLOPT_SSLKEYPASSWD 
            curl_setopt($ch_download, CURLOPT_SSLKEY, $this->pathCertsFiles . $this->CNPJ .'_priKEY.pem');
            // The --cacert option
            curl_setopt($ch_download, CURLOPT_CAINFO, $this->pathCertsFiles . $this->CNPJ .'_certKEY.pem');
            // The --cert option
            curl_setopt($ch_download, CURLOPT_SSLCERT, $this->pathCertsFiles . $this->CNPJ .'_pubKEY.pem');
            // Cert pass
            curl_setopt($ch_download, CURLOPT_SSLCERTPASSWD, $this->certPass);
            curl_setopt($ch_download, CURLOPT_FOLLOWLOCATION, FALSE);
            curl_setopt($ch_download, CURLOPT_REFERER, $url_download);
            //curl_setopt($ch_download, CURLOPT_VERBOSE, 1);
            
            curl_setopt($ch_download, CURLOPT_CONNECTTIMEOUT, 50); 
            curl_setopt($ch_download, CURLOPT_TIMEOUT, 400); //timeout in seconds
            
            // Log
            //curl_setopt($ch_download, CURLOPT_STDERR, fopen("dump", "wb"));
            curl_setopt($ch_download, CURLOPT_USERAGENT, $useragent);
            // Collecting all POST fields
            $postfields_download = array();
            $postfields_download['__EVENTTARGET'] = "";
            $postfields_download['__EVENTARGUMENT'] = "";
            $postfields_download['__VIEWSTATE'] = $viewstate;
            $postfields_download['__VIEWSTATEGENERATOR'] = $stategen;
            $postfields_download['__EVENTVALIDATION'] = $eventValidation;
            $postfields_download['ctl00$txtPalavraChave'] = '';
            $postfields_download['ctl00$ContentPlaceHolder1$btnDownload'] = 'Download do documento*';
            $postfields_download['ctl00$ContentPlaceHolder1$abaSelecionada'] = '';
            $postfields_download['hiddenInputToUpdateATBuffer_CommonToolkitScripts'] = 1;
            
            curl_setopt($ch_download, CURLOPT_POST, 1);
            curl_setopt($ch_download, CURLOPT_POSTFIELDS, $postfields_download);
            
            $response = curl_exec($ch_download); // Get result after login page.
            
            $download_link_arr = array();
            
            //echo($response);
            
            //dd($download_link);
            
            $header_size = curl_getinfo($ch_download, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            //$body = substr($response, $header_size);
            
            curl_close($ch_download);
            
            // Pega o link para download na header
            preg_match_all('/Location: (.*?)\r\n/sm', $header, $download_link_arr);
            $download_link_ = $download_link_arr[1];
            
            // VALIDA
            $download_link = $download_link_[0];
            
            //dd($download_link);
            
            /** DOWNLOAD XML 2 **/
            
            /**
            Download xml
            */
            $ch_download = curl_init();
            curl_setopt($ch_download, CURLOPT_URL, $download_link);
            curl_setopt($ch_download, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch_download, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch_download, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch_download, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch_download, CURLOPT_COOKIEJAR , $this->cookie);
            curl_setopt($ch_download, CURLOPT_COOKIEFILE, $this->cookie);
            
            // this with CURLOPT_SSLKEYPASSWD 
            curl_setopt($ch_download, CURLOPT_SSLKEY, $this->pathCertsFiles . $this->CNPJ .'_priKEY.pem');
            // The --cacert option
            curl_setopt($ch_download, CURLOPT_CAINFO, $this->pathCertsFiles . $this->CNPJ .'_certKEY.pem');
            // The --cert option
            curl_setopt($ch_download, CURLOPT_SSLCERT, $this->pathCertsFiles . $this->CNPJ .'_pubKEY.pem');
            // Cert pass
            curl_setopt($ch_download, CURLOPT_SSLCERTPASSWD, $this->certPass);
            //curl_setopt($ch_download, CURLOPT_VERBOSE, 1);
            curl_setopt($ch_download, CURLOPT_CONNECTTIMEOUT, 50);
            
            $response_xml = curl_exec($ch_download); // Get result after login page.
            
            curl_close($ch_download);
            
            $this->teminated();//sempre encerrar em métodos finais para não dar problema e não depender de quem está chamando a classe para encerrar
            return $response_xml;
            
        } else {
            throw new \Exception('Não foi possível fazer o download do XML, por favor tente novamente (Verifique o Captcha)');
        }
        
    }
    
    /**
     * Faz o download do HTML no site da sefaz sem assinatura
     * @param type $txtCaptcha Captcha fornecedo por getDownloadXMLCaptcha
     * @param type $chNFe Chave de acesso da NF-e
     * @return String HTML da NF-e
     */
    private function getHtmlNfe($txtCaptcha, $chNFe) {
        //@session_start();
        // URL onde a sefaz fornece o botão de download
        $url = "http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=";
        // Arquivo de coockie para armazenar a session
        
        // Simula um browser pelo curl
        $useragent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36';
        /* Start Login process */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_COOKIEJAR , $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($ch, CURLOPT_STDERR, $f);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        // Collecting all POST fields
        $postfields = array();
        $postfields['__EVENTTARGET'] = "";
        $postfields['__EVENTARGUMENT'] = "";
        $postfields['__VIEWSTATE'] = $_SESSION['viewstate'];
        $postfields['__VIEWSTATEGENERATOR'] = $_SESSION['stategen'];
        $postfields['__EVENTVALIDATION'] = $_SESSION['eventValidation'];
        
        $postfields['ctl00$txtPalavraChave'] = "";
        
        $postfields['ctl00$ContentPlaceHolder1$txtChaveAcessoCompleta'] = $chNFe;
        $postfields['ctl00$ContentPlaceHolder1$txtCaptcha'] = $txtCaptcha;
        $postfields['ctl00$ContentPlaceHolder1$btnConsultar'] = 'Continuar';
        $postfields['ctl00$ContentPlaceHolder1$token'] = $_SESSION['token'];
        $postfields['hiddenInputToUpdateATBuffer_CommonToolkitScripts'] = '1';
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        $html = curl_exec($ch); // Get result after login page.
        curl_close($ch);
        
        //echo $html;die;
        
        /* ENTRA NA INFO DA NFE */
        $ch = curl_init();
        $url_det_nfe = 'http://www.nfe.fazenda.gov.br/portal/consultaCompleta.aspx?tipoConteudo=XbSeqxE8pl8=';
        
        curl_setopt($ch, CURLOPT_URL, $url_det_nfe);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_COOKIEJAR , $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($ch, CURLOPT_STDERR, $f);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        //curl_setopt($ch, CURLOPT_POST, 1);
        
        $html = curl_exec($ch); // Get result after login page.
        curl_close($ch);
        
        return $html;
    }
    
    public function getArrayNfe($txtCaptcha, $chNFe){
        $html = $this->getHtmlNfe($txtCaptcha, $chNFe);
        $this->teminated();//sempre encerrar em métodos finais para não dar problema e não depender de quem está chamando a classe para encerrar
        libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            if($dom->loadHTML($html) ){
                $shtml = simplexml_import_dom($dom);
                
                //Ocorreu algum erro na página
                if((string)$shtml->body->div[1]->form->div[2]->div[2]->div[2]->div[0]['id'] == 'ctl00_ContentPlaceHolder1_pnlErro'){
                    throw new Exception( (string) $shtml->body->div[1]->form->div[2]->div[2]->div[2]->div[0]->div->p->span);
                }
                
                $sNfe = $shtml->body->div[1]->form->div[2]->div[2]->div[2]->div[2]->div[1];//Todas as Abas ->div[0]Nfe ->div[1]Emitente ->div[2]Destinatario....
                
                $cabNfe = array();
                $cabNfe['chave_acesso'] = preg_replace('/[^\d]+/i','', $this->getStrXml($shtml->body->div[1]->form->div[2]->div[2]->div[2]->div[2]->div[0]->fieldset->table->tr[0]->td[0]->span) );
                $cabNfe['versao_xml'] = $this->getStrXml($shtml->body->div[1]->form->div[2]->div[2]->div[2]->div[2]->div[0]->fieldset->table->tr[0]->td[2]->span);
                $cabNfe['modelo'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[0]->span);
                $cabNfe['serie'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[1]->span);
                $cabNfe['numero'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[2]->span);
                $cabNfe['data_emissao'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[3]->span);
                $cabNfe['data_saida_entrada'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[4]->span);
                $cabNfe['valor_total'] = $this->getStrXml($sNfe->div[0]->div->fieldset[0]->table->tr->td[5]->span);
                
                $cabNfe['processo'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[0]->td[0]->span );
                $cabNfe['versao_processo'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[0]->td[1]->span );
                $cabNfe['tipo_emissao'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[0]->td[2]->span );
                $cabNfe['finalidade'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[0]->td[2]->span );
                $cabNfe['nat_operacao'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[1]->td[0]->span );
                $cabNfe['tipo_operacao'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[1]->td[1]->span );
                $cabNfe['forma_pagamento'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[1]->td[2]->span );
                $cabNfe['digest_value'] = $this->getStrXml( $sNfe->div[0]->div->fieldset[3]->table->tr[1]->td[2]->span );
                
                               
                $sitNfe = array();
                for($i=1; $i<99;$i++){//Pegar até 99 eventos
                    $ev = $sNfe->div[0]->div->fieldset[4]->table->tr[$i];
                    if($ev == null) break; //não tem mais eventos
                       
                            $sitNfe[$i-1] = array('evento'=>$this->getStrXml($ev->td[0]->span),
                                                    'protocolo'=>$this->getStrXml($ev->td[1]->span),
                                                    'data'=> $this->extraiDataHoraFromHtml( $this->getStrXml($ev->td[2]->span)    ),
                                                    'data_an'=>$this->extraiDataHoraFromHtml($this->getStrXml($ev->td[3]->span) )
                                            
                                                );
                        
                }
                
                $emitente = array();
                //1ª TR(linha)
                $emitente['nome_razao_social'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[0]->td[0]->span );
                $emitente['nome_fantasia'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[0]->td[1]->span );
                //2ª TR (linha)
                $emitente['cpf_cnpj'] = preg_replace('/[^\d]+/i','',  $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[1]->td[0]->span ) );
                $emitente['endereco'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[1]->td[1]->span );
                //3ª TR (linha)
                $emitente['bairro'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[2]->td[0]->span );
                $emitente['cep'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[2]->td[1]->span );
                //4ª TR (linha)
                $emitente['cidade'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[3]->td[0]->span );
                $emitente['telefone'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[3]->td[1]->span );
                //5ª TR (linha)
                $emitente['estado'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[4]->td[0]->span );
                $emitente['pais'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[4]->td[1]->span );
                //6ª TR (linha)
                $emitente['ie'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[5]->td[0]->span );
                $emitente['ie_substituto'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[5]->td[1]->span );
                //7ª TR (linha)
                $emitente['inscricao_municipal'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[6]->td[0]->span );
                $emitente['cidade_fato_ger_icms'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[6]->td[1]->span );
                //8ª TR (linha)
                $emitente['cnae'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[7]->td[0]->span );
                $emitente['reg_tributario'] = $this->getStrXml( $sNfe->div[1]->div->fieldset[0]->table->tr[7]->td[1]->span );
                
                
                $destinatario = array();
                //1ª TR(linha)
                $destinatario['nome_razao_social'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[0]->td[0]->span );
                //2ª TR (linha)
                $destinatario['cpf_cnpj'] = preg_replace('/[^\d]+/i','',  $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[1]->td[0]->span ) );
                $destinatario['endereco'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[1]->td[1]->span );
                //3ª TR (linha)
                $destinatario['bairro'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[2]->td[0]->span );
                $destinatario['cep'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[2]->td[1]->span );
                //4ª TR (linha)
                $destinatario['cidade'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[3]->td[0]->span );
                $destinatario['telefone'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[3]->td[1]->span );
                //5ª TR (linha)
                $destinatario['estado'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[4]->td[0]->span );
                $destinatario['pais'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[4]->td[1]->span );
                //6ª TR (linha)
                $destinatario['indicador_ie'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[5]->td[0]->span );
                $destinatario['ie'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[5]->td[1]->span );
                $destinatario['ie_suframa'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[5]->td[2]->span );
                //7ª TR (linha)
                $destinatario['inscricao_municipal'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[6]->td[0]->span );
                $destinatario['email'] = $this->getStrXml( $sNfe->div[2]->div->fieldset[0]->table->tr[6]->td[1]->span );
               
                //ITENS
                $itens = array();
                for($aba=0; $aba<20; $aba++){
                    if($sNfe->div[$aba]['id'] == 'aba_nft_3'){
                        $sItens = $sNfe->div[$aba]->div->fieldset->div->table;
                        for($i=1; $i<=999999; $i+=2){//primeiro é a linha do produto(geral) depois os detalhes
                            if($sItens[$i] == null){
                                break;
                            }
                            
                            $indItem = count($itens);
                            $itens[$indItem] = array();
                            //cabecalho do item
                            
                            $itens[$indItem]['item'] = $this->getStrXml($sItens[$i]->tr->td[0]->span);
                            $itens[$indItem]['nome'] = $this->getStrXml($sItens[$i]->tr->td[1]->span);
                            $itens[$indItem]['qtd'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i]->tr->td[2]->span) );
                            $itens[$indItem]['unid_comercial'] = $this->getStrXml($sItens[$i]->tr->td[3]->span);
                            $itens[$indItem]['valor_total'] =  $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i]->tr->td[4]->span) );
                            //detalhe dos itens
                                //primeira linha
                                $itens[$indItem]['codigo_produto'] = $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[0]->td[0]->span);
                                $itens[$indItem]['codigo_ncm'] = $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[0]->td[1]->span);
                                $itens[$indItem]['codigo_cest'] = $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[0]->td[2]->span);
                                //segunda linha
                                $itens[$indItem]['codigo_ex_tipi'] = $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[1]->td[0]->span);
                                $itens[$indItem]['cfop'] = $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[1]->td[1]->span);
                                $itens[$indItem]['outras_despesas'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[1]->td[2]->span) );
                                //terceira linha
                                $itens[$indItem]['valor_desconto'] = $this->valorParaPadraoBanco($this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[2]->td[0]->span));
                                $itens[$indItem]['valor_frete'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i+1]->tr->td[0]->table[0]->tr[2]->td[1]->span) );
                                $itens[$indItem]['valor_seguro'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i+1]->tr->td->table[0]->tr[2]->td[2]->span) );
                                
                                /************************************/
                                //primeira linha
                                $itens[$indItem]['indicador_composicao_tot_nfe'] =$this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[0]->td[0]->span);//Indicador de Composição do Valor Total da NF-e
                                //segunda linha
                                $itens[$indItem]['ean_comercial'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[1]->td[0]->span) ;
                                $itens[$indItem]['unidade_comercial'] =  $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[1]->td[1]->span) ;
                                $itens[$indItem]['qtd_comercial'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[1]->td[2]->span) );
                                //terceira linha
                                $itens[$indItem]['ean_tributavel'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[2]->td[0]->span) ;
                                $itens[$indItem]['unidade_tributavel'] =  $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[2]->td[1]->span) ;
                                $itens[$indItem]['qtd_tributavel'] = $this->valorParaPadraoBanco( $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[2]->td[2]->span) );
                                //quarta linha
                                $itens[$indItem]['valor_unitario_comercializacao'] = $this->valorParaPadraoBanco(  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[3]->td[0]->span) );
                                $itens[$indItem]['valor_unitario_tributacao'] = $this->valorParaPadraoBanco(  $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[3]->td[1]->span) );
                                //quinta linha
                                $itens[$indItem]['pedido_compra'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[4]->td[0]->span) ;
                                $itens[$indItem]['item_pedido_compra'] =   $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[4]->td[1]->span) ;
                                $itens[$indItem]['valor_aprox_tributos'] = $this->valorParaPadraoBanco(  $this->getStrXml($sItens[$i+1]->tr->td->table[1]->tr[4]->td[2]->span) );
                                //sexta linha
                                $itens[$indItem]['numero_fci'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[5]->td[0]->span) ;
                                
                                //ICMS Normal e ST ->fieldset[0]
                                $itens[$indItem]['orig_mercadoria'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[6]->td->fieldset[0]->table->tr[0]->td[0]->span) ;
                                $itens[$indItem]    ['trib_icms'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[6]->td->fieldset[0]->table->tr[0]->td[1]->span) ;
                                if($sItens[$i+1]->tr->td[0]->table[1]->tr[6]->td->fieldset[0]->table->tr[0]->td[2] != null)//Modalidade Definição da BC ICMS NORMAL
                                    $itens[$indItem]['modalidade_bc_icms'] =  $this->getStrXml($sItens[$i+1]->tr->td[0]->table[1]->tr[6]->td->fieldset[0]->table->tr[0]->td[2]->span) ;
                                
                                //Parar por aqui, pois depende da tributação do ICMS, se for 41 trás uns campos, se for normal 00 tras outros, então tem que ver com calma
                                //todas as situação de icms e fazer um switch para pegar os campos corretamente e montar como o XML da Nota
                                //que tem tags de ICMS especificas para cada Tipo de Tributação
                                //consultas NFs 2516 0505 8897 8400 0174 5500 2000 0125 3510 0539 1852 e 2613 0150 2210 1900 5448 5500 1000 0841 2711 6404 3592
                                //para exemplos                                                       
                        }
                        break;
                    }
                }//FIm For ITENS
                
                //VOLUMES
                $volumes = array();
                for($aba=0; $aba<20; $aba++){
                    if($sNfe->div[$aba]['id'] == 'aba_nft_5'){
                        $sFieldsSets = $sNfe->div[$aba]->div->fieldset;                        
                        for($i=0; $i<=9; $i++){//varrendo os fieldset para pegar o de Volumes, Antes pode existir o de VEiculo e Transportador
                            if($sFieldsSets[$i] == null){
                                break;
                            }elseif((string)$sFieldsSets[$i]->legend != 'Volumes'){
                                continue;
                            }
                            
                            $volumes['quantidade'] = $this->getStrXml($sFieldsSets[$i]->table->tr[1]->td[0]->span);
                            $volumes['especie'] = $this->getStrXml($sFieldsSets[$i]->table->tr[1]->td[1]->span);
                            $volumes['marca_volumes'] = $this->getStrXml($sFieldsSets[$i]->table->tr[1]->td[2]->span);
                            $volumes['numeracao'] = $this->getStrXml($sFieldsSets[$i]->table->tr[2]->td[0]->span);
                            $volumes['peso_liquido'] = $this->valorParaPadraoBanco( $this->getStrXml($sFieldsSets[$i]->table->tr[2]->td[1]->span) );
                            $volumes['peso_bruto'] = $this->valorParaPadraoBanco(  $this->getStrXml($sFieldsSets[$i]->table->tr[2]->td[2]->span) );
                                                              
                        }
                        break;
                    }
                }//FIm For VOLUMES
                
                $Totais = array();
                //primeira linha
                $Totais['base_calc_icms'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[0]->td[0]->span )  );
                $Totais['valor_icms'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[0]->td[1]->span )  );
                $Totais['valor_icms_desonerado'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[0]->td[2]->span )  );
                $Totais['base_calc_icms_st'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[0]->td[3]->span )  );
                //segunda linha
                $Totais['valor_icms_substituicao'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[1]->td[0]->span )  );
                $Totais['valor_total_produtos'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[1]->td[1]->span )  );
                $Totais['valor_frete'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[1]->td[2]->span )  );
                $Totais['valor_seguro'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[1]->td[3]->span )  );
                //terceira linha
                $Totais['outras_despesas'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[2]->td[0]->span )  );
                $Totais['valor_total_ipi'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[2]->td[1]->span )  );
                $Totais['valor_total_nfe'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[2]->td[2]->span )  );
                $Totais['valor_total_descontos'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[2]->td[3]->span )  );
                //quarta linha
                $Totais['valor_total_ii'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[3]->td[0]->span )  );
                $Totais['valor_total_pis'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[3]->td[1]->span )  );
                $Totais['valor_total_cofins'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[3]->td[2]->span )  );
                $Totais['valor_aprox_tributos'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[3]->td[3]->span )  );
                //quinta linha
                $Totais['valor_total_icms_fcp'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[4]->td[0]->span )  );
                $Totais['valor_total_icms_uf_destino'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[4]->td[1]->span )  );
                $Totais['valor_total_icms_uf_remetente'] = $this->valorParaPadraoBanco(  $this->getStrXml( $sNfe->div[3]->div->fieldset[0]->fieldset[0]->table->tr[4]->td[2]->span )  );
                
                return array('cabecalho'=>$cabNfe, 'eventos'=>$sitNfe, 'emitente'=>$emitente, 'destinatario'=>$destinatario, 'itens'=>$itens, 'totais'=>$Totais, 'volumes'=>$volumes);
            }else{
                throw new Exception("Ocorreu um erro no tratamento das informações consultadas na SEFAZ, favor tente novamente.");
            }
    }
    
    public function extraiDataHoraFromHtml($str){
        $str = preg_replace('/[^\d]+/i', '', $str);
        $dia = substr($str,0,2);
        $mes = substr($str,2,2);
        $ano = substr($str,4,4);
        $hora = substr($str,8,2);
        $min = substr($str,10,2);
        $seg = substr($str,12,2);
        return $dia .'/' . $mes . '/' . $ano . ' ' . $hora . ':'. $min . ':' . $seg;
    }
	
	public static function getStrXml($obj){
        return preg_replace('/[\n\r]+/i','' , preg_replace('/( )+/', ' ',trim(((string) $obj) ) ) );        
    }
	
	public static function valorParaPadraoBanco($valor, $sepDecimal = ',', $sepMilhar = '.', $returnZero = true){
        if($valor == null && $returnZero)
            return 0;
        elseif($valor == null && !$returnZero)
            return null;
        
        $valor = str_replace($sepDecimal, '.', str_replace($sepMilhar, '', $valor) );
        
        if($returnZero && strlen($valor) == 0   )
            $valor = 0;
        elseif(!$returnZero && strlen($valor) == 0)
            $valor = null;
        
        return $valor;
    }
    
    
}

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
	$downloadXml =  DownloadNfeSefaz::getInstance();
	$array = $downloadXml->getArrayNfe($_POST['captcha'], $_POST['chave_acesso']);
	print_r($array);
	die;
}else{
		
	$downloadXml =  DownloadNfeSefaz::getInstance(true);            
	$captcha = $downloadXml->getDownloadXmlCaptcha();
	
}

?>

<form id="form" method="POST">
	<img src="<?php echo $captcha ?>" />
	<input type="text" name="captcha" />
	Chave de acesso:
	<input type="text" name="chave_acesso" />
	
	<input type="submit" value="Enviar" />
</form>