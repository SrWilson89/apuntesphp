"use client"

import { useEffect, useState } from "react"
import { useRouter } from "next/navigation"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { PlusCircle, Home, TrendingUp, TrendingDown, CreditCard, LogOut } from "lucide-react"
import Link from "next/link"

interface User {
  id: number
  name: string
  email: string
}

interface Finca {
  id: number
  nombre: string
  direccion: string
  ingresos_mes: number
  gastos_mes: number
  beneficio_mes: number
}

export default function Dashboard() {
  const [user, setUser] = useState<User | null>(null)
  const [fincas, setFincas] = useState<Finca[]>([])
  const router = useRouter()

  useEffect(() => {
    const userData = localStorage.getItem("user")
    if (!userData) {
      router.push("/")
      return
    }

    setUser(JSON.parse(userData))

    // Datos de ejemplo
    setFincas([
      {
        id: 1,
        nombre: "Casa Rural El Olivar",
        direccion: "Calle Mayor 123, Sevilla",
        ingresos_mes: 2500,
        gastos_mes: 800,
        beneficio_mes: 1700,
      },
      {
        id: 2,
        nombre: "Apartamento Centro",
        direccion: "Plaza España 45, Madrid",
        ingresos_mes: 1800,
        gastos_mes: 600,
        beneficio_mes: 1200,
      },
      {
        id: 3,
        nombre: "Chalet Costa del Sol",
        direccion: "Avenida del Mar 78, Málaga",
        ingresos_mes: 3200,
        gastos_mes: 1200,
        beneficio_mes: 2000,
      },
    ])
  }, [router])

  const handleLogout = () => {
    localStorage.removeItem("user")
    router.push("/")
  }

  const totalIngresos = fincas.reduce((sum, finca) => sum + finca.ingresos_mes, 0)
  const totalGastos = fincas.reduce((sum, finca) => sum + finca.gastos_mes, 0)
  const totalBeneficios = totalIngresos - totalGastos

  if (!user) return null

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center">
              <div className="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                <Home className="w-5 h-5 text-white" />
              </div>
              <h1 className="text-xl font-semibold text-gray-900">Mis Fincas</h1>
            </div>
            <div className="flex items-center space-x-4">
              <span className="text-sm text-gray-700">Hola, {user.name}</span>
              <Button variant="outline" size="sm" onClick={handleLogout}>
                <LogOut className="w-4 h-4 mr-2" />
                Salir
              </Button>
            </div>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Resumen financiero */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Ingresos Mensuales</CardTitle>
              <TrendingUp className="h-4 w-4 text-green-600" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-green-600">€{totalIngresos.toLocaleString()}</div>
              <p className="text-xs text-muted-foreground">Total de todas las fincas</p>
            </CardContent>
          </Card>

          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Gastos Mensuales</CardTitle>
              <TrendingDown className="h-4 w-4 text-red-600" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-red-600">€{totalGastos.toLocaleString()}</div>
              <p className="text-xs text-muted-foreground">Gastos operativos totales</p>
            </CardContent>
          </Card>

          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Beneficio Neto</CardTitle>
              <CreditCard className="h-4 w-4 text-blue-600" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-blue-600">€{totalBeneficios.toLocaleString()}</div>
              <p className="text-xs text-muted-foreground">Ingresos - Gastos</p>
            </CardContent>
          </Card>
        </div>

        {/* Lista de fincas */}
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-2xl font-bold text-gray-900">Mis Propiedades</h2>
          <Link href="/dashboard/fincas/nueva">
            <Button>
              <PlusCircle className="w-4 h-4 mr-2" />
              Nueva Finca
            </Button>
          </Link>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {fincas.map((finca) => (
            <Card key={finca.id} className="hover:shadow-lg transition-shadow cursor-pointer">
              <CardHeader>
                <div className="flex justify-between items-start">
                  <div>
                    <CardTitle className="text-lg">{finca.nombre}</CardTitle>
                    <CardDescription className="mt-1">{finca.direccion}</CardDescription>
                  </div>
                  <Badge variant={finca.beneficio_mes > 0 ? "default" : "destructive"}>
                    {finca.beneficio_mes > 0 ? "Rentable" : "Pérdidas"}
                  </Badge>
                </div>
              </CardHeader>
              <CardContent>
                <div className="space-y-3">
                  <div className="flex justify-between items-center">
                    <span className="text-sm text-gray-600">Ingresos:</span>
                    <span className="font-semibold text-green-600">€{finca.ingresos_mes.toLocaleString()}</span>
                  </div>
                  <div className="flex justify-between items-center">
                    <span className="text-sm text-gray-600">Gastos:</span>
                    <span className="font-semibold text-red-600">€{finca.gastos_mes.toLocaleString()}</span>
                  </div>
                  <div className="flex justify-between items-center pt-2 border-t">
                    <span className="text-sm font-medium">Beneficio:</span>
                    <span className={`font-bold ${finca.beneficio_mes > 0 ? "text-blue-600" : "text-red-600"}`}>
                      €{finca.beneficio_mes.toLocaleString()}
                    </span>
                  </div>
                </div>
                <div className="mt-4 flex space-x-2">
                  <Link href={`/dashboard/fincas/${finca.id}`} className="flex-1">
                    <Button variant="outline" size="sm" className="w-full bg-transparent">
                      Ver Detalles
                    </Button>
                  </Link>
                  <Link href={`/dashboard/fincas/${finca.id}/finanzas`} className="flex-1">
                    <Button size="sm" className="w-full">
                      Finanzas
                    </Button>
                  </Link>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>

        {fincas.length === 0 && (
          <Card className="text-center py-12">
            <CardContent>
              <Home className="w-16 h-16 text-gray-400 mx-auto mb-4" />
              <h3 className="text-lg font-semibold text-gray-900 mb-2">No tienes fincas registradas</h3>
              <p className="text-gray-600 mb-6">Comienza agregando tu primera propiedad para gestionar sus finanzas</p>
              <Link href="/dashboard/fincas/nueva">
                <Button>
                  <PlusCircle className="w-4 h-4 mr-2" />
                  Agregar Primera Finca
                </Button>
              </Link>
            </CardContent>
          </Card>
        )}
      </div>
    </div>
  )
}
