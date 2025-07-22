"use client"

import type React from "react"

import { useState, useEffect } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Badge } from "@/components/ui/badge"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { ArrowLeft, Plus, TrendingUp, TrendingDown, CreditCard, Calendar } from "lucide-react"
import Link from "next/link"

interface Transaccion {
  id: number
  tipo: "ingreso" | "gasto"
  concepto: string
  cantidad: number
  fecha: string
  categoria: string
}

interface CuentaBancaria {
  id: number
  nombre: string
  banco: string
  saldo: number
  numero: string
}

export default function FinanzasFinca() {
  const [transacciones, setTransacciones] = useState<Transaccion[]>([])
  const [cuentas, setCuentas] = useState<CuentaBancaria[]>([])
  const [nuevaTransaccion, setNuevaTransaccion] = useState({
    tipo: "ingreso" as "ingreso" | "gasto",
    concepto: "",
    cantidad: "",
    categoria: "",
  })

  useEffect(() => {
    // Datos de ejemplo
    setTransacciones([
      {
        id: 1,
        tipo: "ingreso",
        concepto: "Alquiler Enero",
        cantidad: 2500,
        fecha: "2024-01-01",
        categoria: "Alquiler",
      },
      {
        id: 2,
        tipo: "gasto",
        concepto: "Reparación fontanería",
        cantidad: 150,
        fecha: "2024-01-05",
        categoria: "Mantenimiento",
      },
      {
        id: 3,
        tipo: "gasto",
        concepto: "Seguro anual",
        cantidad: 650,
        fecha: "2024-01-10",
        categoria: "Seguros",
      },
    ])

    setCuentas([
      {
        id: 1,
        nombre: "Cuenta Principal",
        banco: "Banco Santander",
        saldo: 15420.5,
        numero: "**** **** **** 1234",
      },
      {
        id: 2,
        nombre: "Cuenta Ahorro Fincas",
        banco: "BBVA",
        saldo: 8750.25,
        numero: "**** **** **** 5678",
      },
    ])
  }, [])

  const handleAgregarTransaccion = (e: React.FormEvent) => {
    e.preventDefault()

    const nueva: Transaccion = {
      id: Date.now(),
      tipo: nuevaTransaccion.tipo,
      concepto: nuevaTransaccion.concepto,
      cantidad: Number.parseFloat(nuevaTransaccion.cantidad),
      fecha: new Date().toISOString().split("T")[0],
      categoria: nuevaTransaccion.categoria,
    }

    setTransacciones([nueva, ...transacciones])
    setNuevaTransaccion({
      tipo: "ingreso",
      concepto: "",
      cantidad: "",
      categoria: "",
    })
  }

  const totalIngresos = transacciones.filter((t) => t.tipo === "ingreso").reduce((sum, t) => sum + t.cantidad, 0)

  const totalGastos = transacciones.filter((t) => t.tipo === "gasto").reduce((sum, t) => sum + t.cantidad, 0)

  const beneficioNeto = totalIngresos - totalGastos

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center h-16">
            <Link href="/dashboard">
              <Button variant="ghost" size="sm">
                <ArrowLeft className="w-4 h-4 mr-2" />
                Volver
              </Button>
            </Link>
            <h1 className="text-xl font-semibold text-gray-900 ml-4">Finanzas - Casa Rural El Olivar</h1>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Resumen financiero */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Total Ingresos</CardTitle>
              <TrendingUp className="h-4 w-4 text-green-600" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-green-600">€{totalIngresos.toLocaleString()}</div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Total Gastos</CardTitle>
              <TrendingDown className="h-4 w-4 text-red-600" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-red-600">€{totalGastos.toLocaleString()}</div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Beneficio Neto</CardTitle>
              <CreditCard className="h-4 w-4 text-blue-600" />
            </CardHeader>
            <CardContent>
              <div className={`text-2xl font-bold ${beneficioNeto >= 0 ? "text-blue-600" : "text-red-600"}`}>
                €{beneficioNeto.toLocaleString()}
              </div>
            </CardContent>
          </Card>
        </div>

        <Tabs defaultValue="transacciones" className="space-y-6">
          <TabsList>
            <TabsTrigger value="transacciones">Transacciones</TabsTrigger>
            <TabsTrigger value="cuentas">Cuentas Bancarias</TabsTrigger>
          </TabsList>

          <TabsContent value="transacciones" className="space-y-6">
            {/* Formulario nueva transacción */}
            <Card>
              <CardHeader>
                <CardTitle>Agregar Transacción</CardTitle>
                <CardDescription>Registra un nuevo ingreso o gasto para esta finca</CardDescription>
              </CardHeader>
              <CardContent>
                <form onSubmit={handleAgregarTransaccion} className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div className="space-y-2">
                      <Label htmlFor="tipo">Tipo</Label>
                      <select
                        id="tipo"
                        value={nuevaTransaccion.tipo}
                        onChange={(e) =>
                          setNuevaTransaccion({
                            ...nuevaTransaccion,
                            tipo: e.target.value as "ingreso" | "gasto",
                          })
                        }
                        className="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                        required
                      >
                        <option value="ingreso">Ingreso</option>
                        <option value="gasto">Gasto</option>
                      </select>
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="concepto">Concepto</Label>
                      <Input
                        id="concepto"
                        value={nuevaTransaccion.concepto}
                        onChange={(e) =>
                          setNuevaTransaccion({
                            ...nuevaTransaccion,
                            concepto: e.target.value,
                          })
                        }
                        placeholder="Ej: Alquiler Enero"
                        required
                      />
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="cantidad">Cantidad (€)</Label>
                      <Input
                        id="cantidad"
                        type="number"
                        value={nuevaTransaccion.cantidad}
                        onChange={(e) =>
                          setNuevaTransaccion({
                            ...nuevaTransaccion,
                            cantidad: e.target.value,
                          })
                        }
                        placeholder="0.00"
                        step="0.01"
                        min="0"
                        required
                      />
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="categoria">Categoría</Label>
                      <select
                        id="categoria"
                        value={nuevaTransaccion.categoria}
                        onChange={(e) =>
                          setNuevaTransaccion({
                            ...nuevaTransaccion,
                            categoria: e.target.value,
                          })
                        }
                        className="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                        required
                      >
                        <option value="">Seleccionar</option>
                        <option value="Alquiler">Alquiler</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Seguros">Seguros</option>
                        <option value="Impuestos">Impuestos</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Otros">Otros</option>
                      </select>
                    </div>
                  </div>
                  <Button type="submit">
                    <Plus className="w-4 h-4 mr-2" />
                    Agregar Transacción
                  </Button>
                </form>
              </CardContent>
            </Card>

            {/* Lista de transacciones */}
            <Card>
              <CardHeader>
                <CardTitle>Historial de Transacciones</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {transacciones.map((transaccion) => (
                    <div key={transaccion.id} className="flex items-center justify-between p-4 border rounded-lg">
                      <div className="flex items-center space-x-4">
                        <div
                          className={`w-10 h-10 rounded-full flex items-center justify-center ${
                            transaccion.tipo === "ingreso" ? "bg-green-100" : "bg-red-100"
                          }`}
                        >
                          {transaccion.tipo === "ingreso" ? (
                            <TrendingUp className="w-5 h-5 text-green-600" />
                          ) : (
                            <TrendingDown className="w-5 h-5 text-red-600" />
                          )}
                        </div>
                        <div>
                          <p className="font-medium">{transaccion.concepto}</p>
                          <div className="flex items-center space-x-2 text-sm text-gray-500">
                            <Calendar className="w-4 h-4" />
                            <span>{new Date(transaccion.fecha).toLocaleDateString()}</span>
                            <Badge variant="outline">{transaccion.categoria}</Badge>
                          </div>
                        </div>
                      </div>
                      <div
                        className={`text-lg font-semibold ${
                          transaccion.tipo === "ingreso" ? "text-green-600" : "text-red-600"
                        }`}
                      >
                        {transaccion.tipo === "ingreso" ? "+" : "-"}€{transaccion.cantidad.toLocaleString()}
                      </div>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          </TabsContent>

          <TabsContent value="cuentas" className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {cuentas.map((cuenta) => (
                <Card key={cuenta.id}>
                  <CardHeader>
                    <CardTitle className="flex items-center justify-between">
                      {cuenta.nombre}
                      <Badge variant="outline">{cuenta.banco}</Badge>
                    </CardTitle>
                    <CardDescription>{cuenta.numero}</CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="text-2xl font-bold text-blue-600">€{cuenta.saldo.toLocaleString()}</div>
                    <p className="text-sm text-gray-500 mt-1">Saldo disponible</p>
                  </CardContent>
                </Card>
              ))}
            </div>

            <Card>
              <CardHeader>
                <CardTitle>Agregar Nueva Cuenta</CardTitle>
                <CardDescription>Conecta una nueva cuenta bancaria para esta finca</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="nombre-cuenta">Nombre de la Cuenta</Label>
                    <Input id="nombre-cuenta" placeholder="Ej: Cuenta Principal" />
                  </div>
                  <div className="space-y-2">
                    <Label htmlFor="banco">Banco</Label>
                    <Input id="banco" placeholder="Ej: Banco Santander" />
                  </div>
                  <div className="space-y-2">
                    <Label htmlFor="numero-cuenta">Número de Cuenta</Label>
                    <Input id="numero-cuenta" placeholder="**** **** **** 1234" />
                  </div>
                  <div className="space-y-2">
                    <Label htmlFor="saldo-inicial">Saldo Inicial (€)</Label>
                    <Input id="saldo-inicial" type="number" placeholder="0.00" step="0.01" />
                  </div>
                </div>
                <Button className="mt-4">
                  <Plus className="w-4 h-4 mr-2" />
                  Agregar Cuenta
                </Button>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </div>
    </div>
  )
}
