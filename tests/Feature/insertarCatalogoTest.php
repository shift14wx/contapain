<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class insertarCatalogoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
    
        $response = $this->post("/store/catalogos",
        [
	"catalogo"=> [
		[
			"id_rubro"=> "1",
			"titulo"=> "Activo",
			"tabla"=> "rubro",
			"haber"=> false,
			"debe"=> true,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "11",
					"titulo"=> "Activo corriente",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "1",
					"id_clasificacion"=> "1",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "1101",
							"titulo"=> "Efectivo y equivalente de efectivo",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "11",
							"id_clasificacion"=> "1",
							"subrubro"=> [
								[
									"id_categorias"=> "110101",
									"titulo"=> "Caja general",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "11010102",
									"titulo"=> "Caja chica",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "11010103",
									"titulo"=> "Bancos",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "1101010301",
									"titulo"=> "Cuenta Corriente",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "1101010302",
									"titulo"=> "Cuenta de ahorro",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "1101010304",
									"titulo"=> "Dépositos a plazo",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								],
								[
									"id_categorias"=> "1101010304",
									"titulo"=> "Dépositos a plazo",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1101"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1102",
							"titulo"=> "Inversiones a corto plazo",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11",
							"subrubro"=> [
								[
									"id_categorias"=> "110201",
									"titulo"=> "Acciones",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1102"
								],
								[
									"id_categorias"=> "110202",
									"titulo"=> "Bonos",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1102"
								],
								[
									"id_categorias"=> "110203",
									"titulo"=> "Otros títulos de valor",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1102"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1103",
							"titulo"=> "Cuentas por cobrar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1104",
							"titulo"=> "Documentos por cobrar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1105",
							"titulo"=> "Acciones",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1106",
							"titulo"=> "Prestamos a empleados y acciones",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11",
							"subrubro"=> [
								[
									"id_categorias"=> "110601",
									"titulo"=> "Accionistas",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1106"
								],
								[
									"id_categorias"=> "110602",
									"titulo"=> "Empleados",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1106"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1107",
							"titulo"=> "Otras cuentas por cobrar",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "11",
							"id_clasificacion"=> "1",
							"subrubro"=> [
								[
									"id_categorias"=> "110701",
									"titulo"=> "Anticipos a proveedores",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1107"
								],
								[
									"id_categorias"=> "110702",
									"titulo"=> "Anticipos de salarios a empleados",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1107"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1108",
							"titulo"=> "Estamimación por cuentas incobrables",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1109",
							"titulo"=> "Inventarios",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1110",
							"titulo"=> "Estamimación para deterioro de inventar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1111",
							"titulo"=> "Gastos pagados por anticipos",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11",
							"subrubro"=> [
								[
									"id_categorias"=> "111101",
									"titulo"=> "Seguros",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1111"
								],
								[
									"id_categorias"=> "111102",
									"titulo"=> "Alquileres",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1111"
								],
								[
									"id_categorias"=> "111103",
									"titulo"=> "Papelería y útiles",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1111"
								],
								[
									"id_categorias"=> "111104",
									"titulo"=> "Pago a cuenta",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1111"
								],
								[
									"id_categorias"=> "111105",
									"titulo"=> "Otros gastos pagados por anticipados",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1111"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1112",
							"titulo"=> "IVA crédito fiscal",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						],
						[
							"id_sub_rubro_hijo"=> "1113",
							"titulo"=> "IVA pagado por anticipo",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11",
							"subrubro"=> [
								[
									"id_categorias"=> "111301",
									"titulo"=> "Seguros",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1113"
								],
								[
									"id_categorias"=> "111302",
									"titulo"=> "Alquileres",
									"tabla"=> "categorias",
									"id_clasificacion"=> "1",
									"id_sub_rubro_hijo"=> "1113"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1114",
							"titulo"=> "Pago a cuenta",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "1",
							"id_sub_rubro_padre"=> "11"
						]
					]
				],
				[
					"id_sub_rubro_padre"=> "12",
					"titulo"=> "Activos no corrientes",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "1",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "1201",
							"titulo"=> "Propiedad planta y equipo",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12",
							"subrubro"=> [
								[
									"id_categorias"=> "120101",
									"titulo"=> "Terrenos",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1201"
								],
								[
									"id_categorias"=> "120102",
									"titulo"=> "Edificios",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1201"
								],
								[
									"id_categorias"=> "120103",
									"titulo"=> "Instalaciones",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1201"
								],
								[
									"id_categorias"=> "120104",
									"titulo"=> "Equipo de reparto",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1201"
								],
								[
									"id_categorias"=> "120105",
									"titulo"=> "Mobiliario y equipo",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1201"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1202",
							"titulo"=> "Depreciaciones",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12",
							"subrubro"=> [
								[
									"id_categorias"=> "120201",
									"titulo"=> "Edificio",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1202"
								],
								[
									"id_categorias"=> "120202",
									"titulo"=> "Instalaciones",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1202"
								],
								[
									"id_categorias"=> "120203",
									"titulo"=> "Equipo de reparto",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1202"
								],
								[
									"id_categorias"=> "120204",
									"titulo"=> "Mobiliario y equipo",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1202"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1203",
							"titulo"=> "Instangibles",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12",
							"subrubro"=> [
								[
									"id_categorias"=> "120301",
									"titulo"=> "Crédito mercantil",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1203"
								],
								[
									"id_categorias"=> "120302",
									"titulo"=> "Patentes y marcas",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1203"
								],
								[
									"id_categorias"=> "120303",
									"titulo"=> "Licencias",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1203"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1204",
							"titulo"=> "Amortización de intangibles",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12",
							"subrubro"=> [
								[
									"id_categorias"=> "120401",
									"titulo"=> "Crédito mercantil",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1204"
								],
								[
									"id_categorias"=> "120402",
									"titulo"=> "Patentes y marcas",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1204"
								],
								[
									"id_categorias"=> "120403",
									"titulo"=> "Licencias",
									"tabla"=> "categorias",
									"id_clasificacion"=> "2",
									"id_sub_rubro_hijo"=> "1204"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "1205",
							"titulo"=> "Inversiones permanentes",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12"
						],
						[
							"id_sub_rubro_hijo"=> "1205",
							"titulo"=> "Inversiones permanentes",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12"
						],
						[
							"id_sub_rubro_hijo"=> "1206",
							"titulo"=> "Impuestos sobre la renta diferido",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "2",
							"id_sub_rubro_padre"=> "12"
						]
					]
				]
			]
		],
		[
			"id_rubro"=> "2",
			"titulo"=> "pasivo",
			"tabla"=> "rubro",
			"haber"=> true,
			"debe"=> false,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "21",
					"titulo"=> "pasivo corriente",
					"tabla"=> "sub_rubro_padre",
					"id_clasificacion"=> "3",
					"id_rubro"=> "2",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "2101",
							"titulo"=> "Sobregiros bancarios",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21"
						],
						[
							"id_sub_rubro_hijo"=> "2102",
							"titulo"=> "Proveedores",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "22",
							"subrubro"=> [
								[
									"id_categorias"=> "210201",
									"titulo"=> "Locales",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2101"
								],
								[
									"id_categorias"=> "210202",
									"titulo"=> "Extranjeros",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2101"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2103",
							"titulo"=> "Documentos por cobrar descontados",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "210301",
									"titulo"=> "Pagares",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2103"
								],
								[
									"id_categorias"=> "210302",
									"titulo"=> "Letras de cambio",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2103"
								],
								[
									"id_categorias"=> "210303",
									"titulo"=> "Bonos",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2103"
								],
								[
									"id_categorias"=> "210304",
									"titulo"=> "Otros títulos valores",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2103"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2104",
							"titulo"=> "Documentos por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "210401",
									"titulo"=> "Pagares",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2104"
								],
								[
									"id_categorias"=> "210402",
									"titulo"=> "Letras de cambio",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2104"
								],
								[
									"id_categorias"=> "210403",
									"titulo"=> "Bonos",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2104"
								],
								[
									"id_categorias"=> "210404",
									"titulo"=> "Otros títulos valores",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2104"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2105",
							"titulo"=> "Prestamos por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "210501",
									"titulo"=> "Bancarios",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2105"
								],
								[
									"id_categorias"=> "210502",
									"titulo"=> "Accionistas",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2105"
								],
								[
									"id_categorias"=> "210503",
									"titulo"=> "Otros",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2105"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2106",
							"titulo"=> "Retenciones por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "210601",
									"titulo"=> "ISSS(salud)",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2106"
								],
								[
									"id_categorias"=> "210602",
									"titulo"=> "ISSS(pensión)",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2106"
								],
								[
									"id_categorias"=> "210603",
									"titulo"=> "AFP",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2106"
								],
								[
									"id_categorias"=> "210604",
									"titulo"=> "RENTA",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2106"
								],
								[
									"id_categorias"=> "210605",
									"titulo"=> "IVA",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2106"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2107",
							"titulo"=> "Provisiones por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "210701",
									"titulo"=> "ISSS(salud)",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2107"
								],
								[
									"id_categorias"=> "210702",
									"titulo"=> "ISSS(pensión)",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2107"
								],
								[
									"id_categorias"=> "210703",
									"titulo"=> "AFP",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2107"
								],
								[
									"id_categorias"=> "210704",
									"titulo"=> "INSAFORP",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2107"
								],
								[
									"id_categorias"=> "210705",
									"titulo"=> "Pago a Cuenta",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2107"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2108",
							"titulo"=> "Dividendos por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21"
						],
						[
							"id_sub_rubro_hijo"=> "2109",
							"titulo"=> "IVA débito fiscal",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21"
						],
						[
							"id_sub_rubro_hijo"=> "2110",
							"titulo"=> "IVA percibido y retenido por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "211001",
									"titulo"=> "IVA Percibido",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2110"
								],
								[
									"id_categorias"=> "211002",
									"titulo"=> "IVA Retenido",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2110"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2111",
							"titulo"=> "IVA percibido y retenido por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21",
							"subrubro"=> [
								[
									"id_categorias"=> "211101",
									"titulo"=> "Pago a Cuenta",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2111"
								],
								[
									"id_categorias"=> "211102",
									"titulo"=> "RENTA",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "2111"
								],
								[
									"id_categorias"=> "211103",
									"titulo"=> "IVA",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2111"
								],
								[
									"id_categorias"=> "211104",
									"titulo"=> "Otros",
									"tabla"=> "categorias",
									"id_clasificacion"=> "3",
									"id_sub_rubro_hijo"=> "2111"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "2112",
							"titulo"=> "Cuentas por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21"
						],
						[
							"id_sub_rubro_hijo"=> "2113",
							"titulo"=> "Intereses por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "3",
							"id_sub_rubro_padre"=> "21"
						]
					]
				],
				[
					"id_sub_rubro_padre"=> "22",
					"titulo"=> "pasivo no corriente",
					"tabla"=> "sub_rubro_padre",
					"id_clasificacion"=> "4",
					"id_rubro"=> "2",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "2201",
							"titulo"=> "Prestamos por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "4",
							"id_sub_rubro_padre"=> "22"
						],
						[
							"id_sub_rubro_hijo"=> "2202",
							"titulo"=> "Documentos por pagar",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "4",
							"id_sub_rubro_padre"=> "22"
						],
						[
							"id_sub_rubro_hijo"=> "2203",
							"titulo"=> "Ingresos diferidos",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "4",
							"id_sub_rubro_padre"=> "22"
						],
						[
							"id_sub_rubro_hijo"=> "2204",
							"titulo"=> "Provisión para obligaciones laborales",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "4",
							"id_sub_rubro_padre"=> "22"
						],
						[
							"id_sub_rubro_hijo"=> "2205",
							"titulo"=> "Pasivo por impuesto de renta diferido",
							"id_clasificacion"=> "4",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "22"
						]
					]
				]
			]
		],
		[
			"id_rubro"=> "3",
			"titulo"=> "patrimonio",
			"tabla"=> "rubro",
			"haber"=> true,
			"debe"=> false,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "31",
					"titulo"=> "capital contable",
					"tabla"=> "sub_rubro_padre",
					"id_clasificacion"=> "5",
					"id_rubro"=> "3",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "3101",
							"titulo"=> "Capital social",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "5",
							"id_sub_rubro_padre"=> "31"
						],
						[
							"id_sub_rubro_hijo"=> "3102",
							"titulo"=> "Reserva legal",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "5",
							"id_sub_rubro_padre"=> "31"
						],
						[
							"id_sub_rubro_hijo"=> "3103",
							"titulo"=> "Utilidades retenidas",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "5",
							"id_sub_rubro_padre"=> "31"
						],
						[
							"id_sub_rubro_hijo"=> "3104",
							"titulo"=> "Utilidades del ejercico",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "5",
							"id_sub_rubro_padre"=> "31"
						],
						[
							"id_sub_rubro_hijo"=> "3105",
							"titulo"=> "R pérdidas",
							"tabla"=> "sub_rubro_hijo",
							"id_clasificacion"=> "5",
							"id_sub_rubro_padre"=> "31",
							"subrubro"=> [
								[
									"id_categorias"=> "310501",
									"titulo"=> "R Pérdidas acumuladas",
									"tabla"=> "categorias",
									"id_clasificacion"=> "5",
									"id_sub_rubro_hijo"=> "3105"
								],
								[
									"id_categorias"=> "310502",
									"titulo"=> "R Pérdidas del presente ejercicio",
									"tabla"=> "categorias",
									"id_clasificacion"=> "5",
									"id_sub_rubro_hijo"=> "3105"
								]
							]
						]
					]
				]
			]
		],
		[
			"id_rubro"=> "4",
			"titulo"=> "Cuenta de resultado acreedoras",
			"tabla"=> "rubro",
			"haber"=> true,
			"debe"=> false,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "41",
					"titulo"=> "costos y gastos de operación",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "4",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "4101",
							"titulo"=> "Compras",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "41"
						],
						[
							"id_sub_rubro_hijo"=> "4102",
							"titulo"=> "Gastos sobre compras",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "41"
						],
						[
							"id_sub_rubro_hijo"=> "4103",
							"titulo"=> "Costos de venta",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "41"
						]
					]
				],
				[
					"id_sub_rubro_padre"=> "42",
					"titulo"=> "Gastos operativos",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "4",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "4201",
							"titulo"=> "Gastos de administración",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "42"
						],
						[
							"id_sub_rubro_hijo"=> "4302",
							"titulo"=> "Gastos de ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "42",
							"subrubro"=> [
								[
									"id_categorias"=> "420101",
									"titulo"=> "Sueldos y salarios",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420102",
									"titulo"=> "Comisiones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420103",
									"titulo"=> "Vacaciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420104",
									"titulo"=> "Bonificaciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420105",
									"titulo"=> "Aguinaldos",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420106",
									"titulo"=> "Horas extras",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420107",
									"titulo"=> "Viáticos",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420108",
									"titulo"=> "Indemnizaciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "420109",
									"titulo"=> "Atenciones al personal",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201010",
									"titulo"=> "ISSS (salud)",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201011",
									"titulo"=> "ISSS (pensión)",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201012",
									"titulo"=> "AFP",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201013",
									"titulo"=> "Honorarios",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201015",
									"titulo"=> "Seguros",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201016",
									"titulo"=> "Transportes",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201017",
									"titulo"=> "Agua",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201018",
									"titulo"=> "Comunicaciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201019",
									"titulo"=> "Energía eléctrica",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201020",
									"titulo"=> "Estimación para cuentas incobrables",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201021",
									"titulo"=> "Papelería y útiles",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201022",
									"titulo"=> "Depreciación",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201023",
									"titulo"=> "Mantenimiento y reparación de mobiliario y equipo",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201024",
									"titulo"=> "Mantenimiento y reparación de edificios",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201025",
									"titulo"=> "Mantenimiento y reparaciones de equipo de reparto",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201026",
									"titulo"=> "Publicidad",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201027",
									"titulo"=> "Empaques",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201028",
									"titulo"=> "Atenciones a clientes",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201029",
									"titulo"=> "Multas",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201030",
									"titulo"=> "Combustibles y lubricantes",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201031",
									"titulo"=> "Impuestos municipales",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201032",
									"titulo"=> "Inscripciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201033",
									"titulo"=> "Limpiezas",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201034",
									"titulo"=> "Alquileres",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201035",
									"titulo"=> "Matriculas de comercio",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201036",
									"titulo"=> "Donaciones y contribuciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201037",
									"titulo"=> "Vigilancias",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201038",
									"titulo"=> "Uniformes",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201039",
									"titulo"=> "Amortizaciones",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201040",
									"titulo"=> "Ornatos",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								],
								[
									"id_categorias"=> "4201041",
									"titulo"=> "Otros",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4302"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "4203",
							"titulo"=> "Rebajas y devoluciones sobre ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "42"
						],
						[
							"id_sub_rubro_hijo"=> "4204",
							"titulo"=> "Descuentos sobre ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "42"
						]
					]
				],
				[
					"id_sub_rubro_padre"=> "43",
					"titulo"=> "Gastos no operativos",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "4",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "4301",
							"titulo"=> "Gastos de administración",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "43",
							"subrubro"=> [
								[
									"id_categorias"=> "430101",
									"titulo"=> "Intereses",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4301"
								],
								[
									"id_categorias"=> "430102",
									"titulo"=> "Comisiones bancarias",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4301"
								],
								[
									"id_categorias"=> "430103",
									"titulo"=> "Diferencial cambiario",
									"tabla"=> "categorias",
									"id_sub_rubro_hijo"=> "4301"
								]
							]
						],
						[
							"id_sub_rubro_hijo"=> "4303",
							"titulo"=> "Gastos de ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "43"
						],
						[
							"id_sub_rubro_hijo"=> "4304",
							"titulo"=> "Rebajas y devoluciones sobre ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "43"
						],
						[
							"id_sub_rubro_hijo"=> "4305",
							"titulo"=> "Descuentos sobre ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "43"
						]
					]
				]
			]
		],
		[
			"id_rubro"=> "5",
			"titulo"=> "cuentas de resultado deudoras",
			"tabla"=> "rubro",
			"haber"=> false,
			"debe"=> true,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "51",
					"titulo"=> "Ingresos de operación",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "5",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "5101",
							"titulo"=> "Ventas",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "51"
						],
						[
							"id_sub_rubro_hijo"=> "5102",
							"titulo"=> "Rebajas y devoluciones sobre compras",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "51"
						],
						[
							"id_sub_rubro_hijo"=> "5103",
							"titulo"=> "Descuentos sobre compras",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "51"
						]
					]
				],
				[
					"id_sub_rubro_padre"=> "52",
					"titulo"=> "Ingresos de no operación",
					"tabla"=> "sub_rubro_padre",
					"id_rubro"=> "5",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "5201",
							"titulo"=> "Utilidad en venta activo fijo",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "52"
						],
						[
							"id_sub_rubro_hijo"=> "5202",
							"titulo"=> "Otros ingresos",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "52"
						],
						[
							"id_sub_rubro_hijo"=> "5203",
							"titulo"=> "Ingreso por impuesto de renta diferido",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "52"
						]
					]
				]
			]
		],
		[
			"id_rubro"=> "6",
			"titulo"=> "cuentas de liquidadoras",
			"tabla"=> "rubro",
			"haber"=> true,
			"debe"=> false,
			"subrubro"=> [
				[
					"id_sub_rubro_padre"=> "61",
					"titulo"=> "Cuenta liquidadora",
					"tabla"=> "sub_rubro_padre",
					"id_clasificacion"=> "6",
					"id_rubro"=> "6",
					"subrubro"=> [
						[
							"id_sub_rubro_hijo"=> "6101",
							"titulo"=> "Pérdidas y ganancias",
							"id_clasificacion"=> "6",
							"tabla"=> "sub_rubro_hijo",
							"id_sub_rubro_padre"=> "61"
						]
					]
				]
			]
		]
	]
]
    );
        $response->assertStatus(200);
}
}
