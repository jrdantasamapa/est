//LAYOUT VERSÃO 3.10
"versao" => "3.10"
tag Pai:
"NFe"
	Tags Filho "NFe:
		"NFe"->"infNFe"
		"NFe"->"Signature"

			Tags Sub-filho infNFe:
				"NFe"->"infNFe"->"ide" ->  (
											"cUF",
											"cNF",
											"natOp",
											"indPag"
											"mod",
											"serie",
											"nNF",
											"dhEmi",
											"dhSaiEnt",
											"tpNF",
											"idDest",
											"cMunFG",
											"tpImp",
											"tpEmis",
											"cDV",
											"tpAmb",
											"finNFe",
											"indFinal",
											"indPres",
											"procEmi",
											"verProc"
											)
				"NFe"->"infNFe"->"emit" -> (
											"CNPJ",
											"xNome",
											"xFant",
											"enderEmit" -> (
															"xLgr",
															"nro",
															"xBairro",
															"cMun",
															"xMun",
															"UF",
															"CEP",
															"cPais",
															"xPais",
															"fone"
															)
											"IE",
											"IM",
											"CNAE",
											"CRT"
											)
				"NFe"->"infNFe"->"dest" -> (
											"CNPJ",
											"xNome",
											"enderDest" -> (
															"xLgr",
															"nro",
															"xBairro",
															"cMun",
															"xMun",
															"UF",
															"CEP",
															"cPais",
															"xPais",
															"fone"
															)
											"indIEDest",
											"IE",
											"ISUF"
											)
				"NFe"->"infNFe"->"det" -> (
											nItem -> (
														"prod" -> (
																	"cProd",
																	"cEAN",
																	"xProd",
																	"NCM",
																	"CFOP",
																	"uCom",
																	"qCom",
																	"vUnCom",
																	"vProd",
																	"cEANTrib",
																	"uTrib",
																	"qTrib",
																	"vUnTrib",
																	"indTot",
																	"xPed",
																	"nFCI"
																	)
														"imposto"-> (
																	"ICMS" -> (
																		"ICMS40" -> (
																					"orig",
																					"CST",
																					"vICMSDeson",
																					"motDesICMS"
																					)
																	  		  )
																	"IPI" -> (
																			  "cEnq"
																			  "IPINT" -> (
																						  "CST"
																						 )
														 					   )
														 			"PIS" -> (
																			  "PISNT" -> (
																						"CST"
																						)
														 					 )
														 			"COFINS" -> (
																				"COFINSNT" -> (
																								"CST"
																							  )
																				)		 
																	)
												 		"infAdProd"
													)
				"NFe"->"infNFe"->"total" -> (
											 "ICMSTot" -> (
															"vBC",
															"vICMS",
															"vICMSDeson",
															"vBCST",
															"vST",
															"vProd",
															"vFrete",
															"vSeg",
															"vDesc",
															"vII",
															"vIPI",
															"vPIS",
															"vCOFINS",
															"vOutro",
															"vNF"
															)
											)
				"NFe"->"infNFe"->"transp" -> (
											   "modFrete",
											   "transporta" -> (
																"CNPJ",
																"xNome",
																"IE",
																"xEnder",
																"xMun",
																"UF"
											   					)
											 )
				"NFe"->"infNFe"->"cobr" -> (
											"fat" -> (
														"nFat",
														"vOrig",
														"vDesc",
														"vLiq"
													 )
											"dup" -> (
														"nDup",
														"dVenc",
														"vDup"
														)
											)
				"NFe"->"infNFe"->"infAdic" -> (
												"infCpl"	
												)

			Tags Sub-filho Signature:
				"NFe"->"Signature"->SignedInfo" -> (
													"CanonicalizationMethod"->"Algorithm"
													"SignatureMethod"->"Algorithm"
													"Reference" -> (
																	"Transforms"->(
																					"Transform"->"Algorithm"
																					)
																	"DigestMethod"->"Algorithm"
																	"DigestValue"
																	)
													)
				"NFe"->"Signature"->"SignatureValue"
				"NFe"->"Signature"->"KeyInfo" -> (
												   "X509Data" -> (
																"X509Certificate"
													  			)
													)
tag Pai:									
"protNFe"
	Tags Filho "protNFe:
		"protNFe"->"infProt"

			Tags Sub-filho infProt:
				"protNFe"->"infProt"->"Id"
				"protNFe"->"infProt"-> (
										"tpAmb",
										"verAplic",
										"chNFe",
										"dhRecbto",
										"nProt",
										"digVal",
										"cStat",
										"xMotivo"
										)	
------------------------------------------------------------------

//LAYOUT VERSÃO 1.10
"versao" => "1.10"
tag Pai:
"NFe"
	Tags Filho "NFe:
		"NFe"->"infNFe"
		"NFe"->"Signature"

			Tags Sub-filho infNFe:
				"NFe"->"infNFe"->"ide" ->  (
											"cUF",
											"cNF",
											"natOp",
											"indPag",
											"mod",
											"serie",
											"nNF",
											"dEmi",
											"dSaiEnt",
											"tpNF",
											"cMunFG",
											"tpImp",
											"tpEmis",
											"cDV",
											"tpAmb",
											"finNFe",
											"procEmi",
											"verProc"
											)
				"NFe"->"infNFe"->"emit" -> (
											"CNPJ",
											"xNome",
											"xFant",
											"enderEmit" -> (
															"xLgr",
															"nro",
															"xCpl",
															"xBairro",
															"cMun",
															"xMun",
															"UF",
															"CEP",
															"cPais",
															"xPais>",
															"fone"
															)
											"IE
											)
				"NFe"->"infNFe"->"dest" -> (
											"CNPJ",
											"xNome",
											"enderDest" -> (
															"xLgr",
															"nro",
															"xCpl",
															"xBairro",
															"cMun",
															"xMun",
															"UF",
															"CEP",
															"cPais>",
															"xPais",
															"fone"
															)
											"IE"
											)
				"NFe"->"infNFe"->"retirada" -> (
												"CNPJ",
												"xLgr",
												"nro",
												"xCpl",
												"xBairro",
												"cMun",
												"xMun",
												"UF"
												)
				"NFe"->"infNFe"->"entrega" -> (
												"CNPJ,
												"xLgr,
												"nro,
												"xCpl,
												"xBairro,
												"cMun,
												"xMun,
												"UF
												)
				"NFe"->"infNFe"->"det" -> (
											nItem -> (
														"prod" -> (
																	"cProd",
																	"cEAN",
																	"xProd",
																	"CFOP",
																	"uCom",
																	"qCom",
																	"vUnCom",
																	"vProd",
																	"cEANTrib",
																	"uTrib",
																	"qTrib",
																	"vUnTrib"
																	)
														imposto" -> (
																	"ICMS" -> (
																				"ICMS00" -> (
																							"orig",
																							"CST",
																							"modBC",
																							"vBC",
																							"pICMS",
																							"vICMS"
																							)
																				)
																	"PIS" -> (
																				"PISAliq" -> (
																							"CST",
																							"vBC",
																							"pPIS",
																							"vPIS"
																							)
																			 )
																	"COFINS" -> (
																				"COFINSAliq" -> (
																								"CST",
																								"vBC",
																								"pCOFINS",
																								"vCOFINS"
																								)
																				)
																)
													)
											)	
				"NFe"->"infNFe"->"total" -> (
											"ICMSTot" -> (
															"vBC",
															"vICMS",
															"vBCST",
															"vST",
															"vProd",
															"vFrete",
															"vSeg",
															"vDesc",
															"vII",
															"vIPI",
															"vPIS",
															"vCOFINS",
															"vOutro",
															"vNF"
															)
											)
				"NFe"->"infNFe"->"transp" -> (
												"modFrete"
												"transporta" -> (
																"CNPJ",
																"xNome",
																"IE",
																"xEnder",
																"xMun",
																"UF"
																)

												"veicTransp" -> (
																"placa",
																"UF",
																"RNTC"
																)
												"reboque" -> (
															"placa",
															"UF",
															"RNTC"
															)
												"vol" -> (
														"qVol",
														"esp",
														"marca",
														"nVol",
														"pesoL",
														"pesoB",
														"lacres" -> (
																	"nLacre"
																	)
														)
												)
				"NFe"->"infNFe"->"infAdic" -> (
											  "infAdFisco"
											  )												

			Tags Sub-filho Signature:
				"NFe"->"Signature"->SignedInfo" -> (
													"CanonicalizationMethod"->"Algorithm"
													"SignatureMethod"->"Algorithm"
													"Reference" -> (
																	"Transforms"->(
																					"Transform"->"Algorithm"
																					"Transform"->"Algorithm"
																					)
																	"DigestMethod"->"Algorithm"
																	"DigestValue"
																	)
													)
				"NFe"->"Signature"->"SignatureValue"
				"NFe"->"Signature"->"KeyInfo" -> (
												   "X509Data" -> (
																"X509Certificate"
													  			)
													)

------------------------------------------------------------------

//LAYOUT VERSÃO 2
"versao" => "2.0"

tag Pai:
"NFe"
	Tags Filho "NFe:
		"NFe"->"infNFe"
		"NFe"->"Signature"

		Tags Sub-filho infNFe:
				"NFe"->"infNFe"->"ide" ->  (
											"cUF",
											"cNF",
											"natOp",
											"indPag",
											"mod",
											"serie",
											"nNF",
											"dEmi",
											"dSaiEnt",
											"hSaiEnt",
											"tpNF",
											"cMunFG",
											"tpImp",
											"tpEmis",
											"cDV",
											"tpAmb",
											"finNFe",
											"procEmi",
											"verProc"
											)
				"NFe"->"infNFe"->"emit" -> (
											"CNPJ",
											"xNome",
											"xFant",
											"enderEmit" -> (
															"xLgr",
															"nro",
															"xCpl",
															"xBairro",
															"cMun",
															"xMun",
															"UF",
															"CEP",
															"cPais",
															"xPais>",
															"fone"
															)
											"IE",
											"IM",
											"CNAE",
											"CRT"
											)
				"NFe"->"infNFe"->"dest" -> (
											"CNPJ",
											"xNome",
											"enderDest" -> (
															"xLgr"
															"nro"
															"xBairro"
															"cMun"
															"xMun"
															"UF"
															"CEP"
															"cPais"
															"xPais"
															"fone"
															)
											"IE"
											)
				"NFe"->"infNFe"->"det" -> (
							"nItem" -> (
										"prod" -> (
													"cProd",
													"cEAN",
													"xProd",
													"NCM",
													"CFOP",
													"uCom",
													"qCom",
													"vUnCom",
													"vProd",
													"cEANTrib",
													"uTrib",
													"qTrib",
													"vUnTrib",
													"indTot",
													"xPed",
													"nFCI"
													)
										"imposto" -> (
													"ICMS" -> (
																"ICMS00" -> (
																			"orig",
																			"CST",
																			"modBC",
																			"vBC",
																			"pICMS",
																			"vICMS"
																			)
																)

													"IPI" -> (
														"cEnq"
														"IPITrib" -> (
																	"CST",
																	"vBC",
																	"pIPI",
																	"vIPI"
																	)
															)
													"PIS" -> (
																"PISAliq" -> (
																			"CST",
																			"vBC",
																			"pPIS",
																			"vPIS"
																			)
															)				
													"COFINS" -> (
																"COFINSAliq" -> (
																				"CST",
																				"vBC",
																				"pCOFINS",
																				"vCOFINS"
																				)
																)
														)
														)
														)
				"NFe"->"infNFe"->"total" -> (
											"ICMSTot" -> (
															"vBC",
															"vICMS",
															"vBCST",
															"vST",
															"vProd",
															"vFrete",
															"vSeg",
															"vDesc",
															"vII",
															"vIPI",
															"vPIS",
															"vCOFINS",
															"vOutro",
															"vNF"
															)
											)
				"NFe"->"infNFe"->"transp" -> (
								"modFrete"
								"transporta" -> (
												"CNPJ",
												"xNome",
												"IE",
												"xEnder",
												"xMun",
												"UF"
												)
								)
				"NFe"->"infNFe"->"cobr" -> (
											"fat" -> (
														"nFat",
														"vOrig",
														"vLiq"
													 )
											"dup" -> (
														"nDup",
														"dVenc",
														"vDup"
														)
											)
				"NFe"->"infNFe"->"infAdic" -> (
											  "infAdFisco"
											  )												

		Tags Sub-filho Signature:
				"NFe"->"Signature"->SignedInfo" -> (
													"CanonicalizationMethod"->"Algorithm"
													"SignatureMethod"->"Algorithm"
													"Reference" -> (
																	"Transforms"->(
																					"Transform"->"Algorithm"
																					"Transform"->"Algorithm"
																					)
																	"DigestMethod"->"Algorithm"
																	"DigestValue"
																	)
													)
				"NFe"->"Signature"->"SignatureValue"
				"NFe"->"Signature"->"KeyInfo" -> (
												   "X509Data" -> (
																"X509Certificate"
													  			)
													)


tag Pai:									
"protNFe"
	Tags Filho "protNFe:
		"protNFe"->"infProt"

			Tags Sub-filho infProt:
				"protNFe"->"infProt"->"Id"
				"protNFe"->"infProt"-> (
										"tpAmb",
										"verAplic",
										"chNFe",
										"dhRecbto",
										"nProt",
										"digVal",
										"cStat",
										"xMotivo"
										)	
