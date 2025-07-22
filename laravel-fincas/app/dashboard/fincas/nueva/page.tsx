"use client"

import type React from "react"

import { useState } from "react"
import { useRouter } from "next/navigation"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Textarea } from "@/components/ui/textarea"
import { ArrowLeft, Save } from "lucide-react"
import Link from "next/link"

export default function NuevaFinca() {
  const [isLoading, setIsLoading] = useState(false)
  const router = useRouter()

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    setIsLoading(true)

    // Simular guardado
    await new Promise((resolve) => setTimeout(resolve, 1000))

    setIsLoading(false)
    router.push("/dashboard")
  }

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
            <h1 className="text-xl font-semibold text-gray-900 ml-4">Nueva Finca</h1>
          </div>
        </div>
      </header>

      <div className="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <Card>
          <CardHeader>
            <CardTitle>Agregar Nueva Propiedad</CardTitle>
            <CardDescription>Completa la información básica de tu nueva finca</CardDescription>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="nombre">Nombre de la Finca</Label>
                  <Input id="nombre" name="nombre" placeholder="Ej: Casa Rural El Olivar" required />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="tipo">Tipo de Propiedad</Label>
                  <select
                    id="tipo"
                    name="tipo"
                    className="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    required
                  >
                    <option value="">Seleccionar tipo</option>
                    <option value="casa">Casa</option>
                    <option value="apartamento">Apartamento</option>
                    <option value="chalet">Chalet</option>
                    <option value="local">Local Comercial</option>
                    <option value="terreno">Terreno</option>
                  </select>
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="direccion">Dirección Completa</Label>
                <Textarea
                  id="direccion"
                  name="direccion"
                  placeholder="Calle, número, ciudad, código postal..."
                  required
                />
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="ingresos">Ingresos Mensuales (€)</Label>
                  <Input id="ingresos" name="ingresos" type="number" placeholder="2500" min="0" step="0.01" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="gastos">Gastos Mensuales (€)</Label>
                  <Input id="gastos" name="gastos" type="number" placeholder="800" min="0" step="0.01" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="valor">Valor de la Propiedad (€)</Label>
                  <Input id="valor" name="valor" type="number" placeholder="150000" min="0" step="0.01" />
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="descripcion">Descripción (Opcional)</Label>
                <Textarea
                  id="descripcion"
                  name="descripcion"
                  placeholder="Detalles adicionales sobre la propiedad..."
                  rows={3}
                />
              </div>

              <div className="flex justify-end space-x-4">
                <Link href="/dashboard">
                  <Button variant="outline" type="button">
                    Cancelar
                  </Button>
                </Link>
                <Button type="submit" disabled={isLoading}>
                  <Save className="w-4 h-4 mr-2" />
                  {isLoading ? "Guardando..." : "Guardar Finca"}
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
