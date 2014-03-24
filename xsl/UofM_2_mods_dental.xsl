<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:mods="http://www.loc.gov/mods/v3" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:output method="html" encoding="utf-8"/>
    <xsl:include href="string-utilities.xsl" />

    <xsl:param name="islandoraUrl"/>
    <xsl:param name="PID"/>

    <xsl:template match="mods:mods" priority="2">
      <xsl:if test="mods:subject[@displayLabel='title' or @displayLabel='subject' or @displayLabel='general' or @displayLabel='removable']">
      <div class="uofm-dental-info">
        <h2>Information (show)</h2>
        <table>
          <tbody>
          <xsl:apply-templates />
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" class="more-info"><a href="{concat($islandoraUrl,'/islandora/object/',$PID,'/manitoba_metadata')}">more information</a></td>
            </tr>
          </tfoot>
        </table>
      </div>
      </xsl:if>
    </xsl:template>

  <xsl:template match="mods:subject[@displayLabel='title']|mods:subject[@displayLabel = 'subject']|mods:subject[@displayLabel = 'general']|mods:subject[@displayLabel = 'removable']" priority="5">
    <xsl:call-template name="dental_output">
      <xsl:with-param name="label"><xsl:call-template name="toProperCase"><xsl:with-param name="text" select="@displayLabel" /></xsl:call-template></xsl:with-param>
      <xsl:with-param name="node" select="."/>
    </xsl:call-template>
  </xsl:template>

  <xsl:template name="dental_output">
    <xsl:param name="label" />
    <xsl:param name="node" />
    <xsl:call-template name="basic_output">
      <xsl:with-param name="label"><xsl:value-of select="$label"/></xsl:with-param>
      <xsl:with-param name="content">
        <xsl:for-each select="$node/mods:topic">
          <xsl:value-of select="text()" /><xsl:if test="not(position() = last())"><br /></xsl:if>
        </xsl:for-each>
      </xsl:with-param>
    </xsl:call-template>
  </xsl:template>

  <!-- BASIC OUTPUT TEMPLATE -->
  <xsl:template name="basic_output">
    <xsl:param name="label"/>
    <xsl:param name="content" />
    <xsl:if test="string-length($label) &gt; 0 and string-length($content) &gt; 0">
      <tr>
          <td class="label"><xsl:value-of select="$label"/>:</td>
          <td><xsl:copy-of select="$content"/></td>
      </tr>
    </xsl:if>
  </xsl:template>
  <!-- BASIC OUTPUT TEMPLATE -->

  <xsl:template match="*" priority="-1" />
</xsl:stylesheet>