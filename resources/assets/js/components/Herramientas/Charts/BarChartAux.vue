<script>
import
{
    Bar
}
from 'vue-chartjs'

export default
{
    extends: Bar,
    props:
    {
        data:
        {
            type: Object,
            required: true,
        },
        options:
        {
            type: Object,
            required: true,
        }
    },
    methods:
    {
        Mostrar()
        {
            this.renderChart(this.data, this.options)
        }
    },
    mounted()
    {}
}
</script>
