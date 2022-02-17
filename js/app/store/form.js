import React from 'react'
import { render } from 'react-dom'
import TagsSelect from '../components/TagsSelect'
import { addressMapper } from '../widgets/addressForm'
import _ from 'lodash'

var tagsEl = document.querySelector('#store_tags');

if (tagsEl) {

  const el = document.createElement('div')
  tagsEl.closest('.form-group').appendChild(el)

  tagsEl.classList.add('d-none')

  const tags = JSON.parse(tagsEl.dataset.tags)
  const defaultValue = tagsEl.value

  render(
    <TagsSelect
      tags={ tags }
      defaultValue={ defaultValue }
      onChange={ tags => {
        const slugs = tags.map(tag => tag.slug)
        tagsEl.value = slugs.join(' ')
      } } />, el)
}

$('#address-form-modal').on('show.bs.modal', function (event) {
  var modal = $(this)
  var button = $(event.relatedTarget) // Button that triggered the modal
  var address = button.data('address')
  var newAddress = button.data('newAddress')
  var addressObj = button.data('addressObj')

  if (address && addressObj) {

    var streetAddress = button.data('streetAddress')
    var name = button.data('name')
    var description = button.data('description')
    var telephone = button.data('telephone')
    var contactName = button.data('contactName')

    modal.find('form input[type="search"]').val(streetAddress)

    // Map form fields
    addressMapper(modal.find('form input[type="search"]').get(0), addressObj)

    modal.find('#address_name').val(name)
    modal.find('#address_description').val(description)
    modal.find('#address_telephone').val(telephone)
    modal.find('#address_contactName').val(contactName)

    modal.find('form').attr('action', address)
  } else {
    modal.find('#address_name').val('')
    modal.find('#address_description').val('')
    modal.find('#address_telephone').val('')
    modal.find('#address_contactName').val('')

    modal.find('form').attr('action', newAddress)
  }
})

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  window.location.hash = e.target.getAttribute('aria-controls')
})

if (window.location.hash !== '') {
  $(`a[aria-controls="${window.location.hash.substring(1)}"]`).tab('show')
}

const timeSlotsEl = document.querySelector('#store_timeSlots')
const timeSlotEl = document.querySelector('#store_timeSlot')

if (timeSlotsEl && timeSlotEl) {
  timeSlotsEl.querySelectorAll('input[type="checkbox"]').forEach(chk => {
    chk.addEventListener('change', () => {

      const checked = timeSlotsEl.querySelectorAll('input[type="checkbox"]:checked')
      const values = Array.from(checked).map(el => el.value)

      if (!_.includes(values, timeSlotEl.value)) {
        timeSlotEl.value = values[0]
      }
    })
  })
}
